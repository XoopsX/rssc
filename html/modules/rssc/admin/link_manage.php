<?php
// $Id: link_manage.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// webmap3_api_gicon

// 2009-02-20 K.OHWADA
// _build_ele_gicon()

// 2008-01-20 K.OHWADA
// post_plugin

// 2007-11-01 K.OHWADA
// enclosure censor plugin
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// link_xml_handler, xml_handler
// api/refresh.php
// use get_ltype_option()
// use feed_list_lid.php

// 2007-05-19 K.OHWADA
// BUG: dont show admin frame

// 2006-09-20 K.OHWADA
// show bread crumb
// use XoopsGTicket
// add _refresh_link_error() etc
// use rssc_xml_utlity : not use rssc_link_exist_handler
// use build_lib_button_hidden_array()
// use _check_url_by_post()
// use RSSC_CODE_PARSE_NOT_READ_XML_URL

// 2006-07-18 K.OHWADA
// BUG 4145: 'blong link' jump always 'rssc' directory

// 2006-07-08 K.OHWADA
// move class admin_manage_link from admin_manage_class.php
// move class admin_form_link   from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx
// link exist check
//   add check_exist_rssurl()

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once RSSC_ROOT_PATH.'/api/refresh.php';
include_once RSSC_ROOT_PATH.'/admin/admin_manage_base_class.php';

//=========================================================
// class link manage
//=========================================================
class admin_manage_link extends admin_manage_base
{

	var $_MODE = RSSC_C_MODE_AUTO;	// auto discovery
	var $_REFRESH_INTERVAL = 86400;	// 24 hours
	var $_sel_rss_atom = RSSC_C_SEL_ATOM;
	var $_HEADER = 'Content-Type:text/xml; charset=utf-8';

// handler
	var $_refresh_handler;
	var $_parser;
	var $_utility;

// local
	var $_parse_result = '';

// debug
	var $_FLAG_REFRESH_REDIRECT = true;
	var $_TIME_SUCCESS = 1 ;
	var $_TIME_FAILED  = 5 ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_link()
{
	$this->admin_manage_base();

	$this->set_handler( 'link_xml', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'lid' );
	$this->set_form_class( 'admin_form_link' );
	$this->set_script(   'link_manage.php' );
	$this->set_redirect( 'link_list.php', 'link_list.php?sortid=1' );
	$this->set_title( _AM_RSSC_ADD_LINK, _AM_RSSC_MOD_LINK, _AM_RSSC_DEL_LINK );
	$this->set_flag_execute_time( true );

// handler
	$this->_refresh_handler =& rssc_get_handler('refresh',    RSSC_DIRNAME);
	$this->_parser          =& happy_linux_rss_parser::getInstance();
	$this->_utility         =& happy_linux_rss_utility::getInstance();

}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_link();
	}
	return $instance;
}

//---------------------------------------------------------
// main_add_form()
//---------------------------------------------------------
function main_add_form()
{
	$this->_main_add_form();
}

function _print_add_form()
{
	$obj =& $this->_handler->create();
	$obj->set('uid',     $this->_system->get_uid() );
	$obj->set('mid',     $this->_system->get_mid() );
	$obj->set('mode',    $this->_MODE );
	$obj->set('refresh', $this->_REFRESH_INTERVAL );

	$this->_form->_show_add($obj);
	return true;
}

//---------------------------------------------------------
// main_add_table()
//---------------------------------------------------------
function main_add_table()
{
	$this->_clear_errors();

	if ( !$this->_check_token() || !$this->_check_add_table() )
	{
		$this->_print_add_preview();
		exit();
	}

	if ( $this->_exec_add_table() )
	{
		$this->_print_cp_header();
		$this->_print_bread_op( _AM_RSSC_ADD_LINK, 'add_form', _RSSC_REFRESH_LINK );
		$this->_print_title(    _AM_RSSC_ADD_LINK );
		echo "<h4>"._AM_RSSC_DBUPDATED."</h4>\n";
		$this->_form->show_refresh_link( $this->_newid, 0 );

// BUG: dont show admin frame
		$this->_print_cp_footer();

		exit();
	}
	else
	{
		$this->_print_add_db_error();
		exit();
	}
}

function _check_add_table()
{
	$ret = $this->_check_add_mod();
	if ( !$ret )
	{	return false;	}

	$ret = $this->_check_exist_rssurl();
	return $ret;
}

function _check_add_mod()
{
	$flag_rdf  = false;
	$flag_rss  = false;
	$flag_atom = false;

	$mode = $this->_post->get_post_int('mode');
	switch ($mode)
	{
		case RSSC_C_MODE_RDF:
			$flag_rdf = true;
			break;

		case RSSC_C_MODE_RSS:
			$flag_rss = true;
			break;

		case RSSC_C_MODE_ATOM:
			$flag_atom = true;
			break;
	}

// check fill
	$this->_check_fill_by_post( 'title',    _RSSC_SITE_TITLE);
	$this->_check_url_by_post(  'url',      _RSSC_SITE_LINK);
	$this->_check_url_by_post(  'rdf_url',  _RSSC_RDF_URL,  $flag_rdf );
	$this->_check_url_by_post(  'rss_url',  _RSSC_RSS_URL,  $flag_rss );
	$this->_check_url_by_post(  'atom_url', _RSSC_ATOM_URL, $flag_atom );
	return $this->returnExistError();
}

function _exec_add_table()
{
	if ( $this->_DEBUG_INSERT )
	{
		$obj =& $this->_handler->create();
		$obj->_set_vars_insert();
		$newid = $this->_handler->insert($obj);
		if ( !$newid ) 
		{
			$this->_set_errors( $this->_LANG_FAIL_ADD );
			$this->_set_errors( $this->_handler->getErrors() );
			return false;
		}

		$this->_newid = $newid;
		return true;
	}
	$this->_newid = $this-_DEBUG_NEWID;
	return true;
}

//---------------------------------------------------------
// main_mod_form()
//---------------------------------------------------------
function main_mod_form()
{
	$this->_main_mod_form();
}

//---------------------------------------------------------
// main_mod_table()
//---------------------------------------------------------
function main_mod_table()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( $this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	if ( !$this->_check_token() || !$this->_check_mod_table() )
	{
		$this->_print_mod_preview();
		exit();
	}

// not need modfiy xml_table in _exec_mod_table()
	if ( $this->_exec_mod_table() )
	{
		$this->_print_cp_header();
		$this->_print_bread_op( _AM_RSSC_MOD_LINK, 'mod_form', _RSSC_REFRESH_LINK );
		$this->_print_title(    _AM_RSSC_MOD_LINK );
		echo "<h3>"._AM_RSSC_DBUPDATED."</h3>\n";
		$this->_form->show_refresh_link( $this->_modid, 1 );

// BUG: dont show admin frame
		$this->_print_cp_footer();

		exit();
	}
	else
	{
		$this->_print_mod_db_error();
		exit();
	}
}

function _check_mod_table()
{
	$this->_clear_errors();
	$this->_check_add_mod();
	return $this->returnExistError();
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function main_del_table()
{
	$this->_main_del_table( true );
}

//---------------------------------------------------------
// main_addlink()
//---------------------------------------------------------
function main_addlink()
{
	$this->_print_cp_header();
	$this->_print_menu();
	$this->_print_title( _AM_RSSC_ADD_LINK );

	if ( !$this->_print_add_link() )
	{
		$this->_print_error(1);
	}
}

function _print_add_link()
{
	$fid  = $this->_post->get_get_int('fid');

	$feed = $this->_get_feed_by_fid($fid);
	if ( !$feed )
	{
		return false;
	}

	$feed_title = $feed['title'];
	$feed_link  = $feed['link'];

	$parse_obj =& $this->_parser->discover_and_parse_by_html_url( $feed_link );
	if ( is_object($parse_obj) )
	{
		$title    = $parse_obj->get_channel_by_key('title');
		$url      = $parse_obj->get_channel_by_key('link');
		$xml_mode = $this->_parser->get_xml_mode();
		$rdf_url  = $this->_parser->get_rdf_url();
		$rss_url  = $this->_parser->get_rss_url();
		$atom_url = $this->_parser->get_atom_url();
		$encoding = $this->_parser->get_xml_encoding();
	}
	else
	{
		$title    = $feed_title;
		$url      = $feed_link;
		$xml_mode = $this->_MODE;
		$rdf_url  = '';
		$rss_url  = '';
		$atom_url = '';
		$encoding = '';
	}

	$obj =& $this->_handler->create();
	$obj->set('uid',      $this->_system->get_uid() );
	$obj->set('mid',      $this->_system->get_mid() );
	$obj->set('mode',     intval($xml_mode) );
	$obj->set('refresh',  $this->_REFRESH_INTERVAL );
	$obj->setVar('title',    $title,    true );
	$obj->setVar('url',      $url,      true );
	$obj->setVar('rdf_url',  $rdf_url,  true );
	$obj->setVar('rss_url',  $rss_url,  true );
	$obj->setVar('atom_url', $atom_url, true );
	$obj->setVar('encoding', $encoding, true );

	$this->_form->_show_add($obj);
	return true;
}

//---------------------------------------------------------
// main_refresh_link()
//---------------------------------------------------------
function main_refresh_link()
{
	if ( $this->_check_token() && $this->_exec_refresh_link() )
	{
		if ( $this->_FLAG_REFRESH_REDIRECT )
		{
			$this->_refresh_link_redirect();
		}
		exit();
	}

	$this->_refresh_link_error();
}

function _exec_refresh_link()
{
	$lid = $this->_post->get_post_int('lid');
	$this->_refresh_handler->set_force_refresh(1);

	$ret = $this->_refresh_handler->refresh_link_for_add_link( $lid );
	switch ( $ret )
	{
		case 0:
			return true;

		case RSSC_CODE_PARSE_MSG:
			$this->_parse_result = $this->_refresh_handler->get_parse_result();
			return true;

		case RSSC_CODE_PARSE_NOT_READ_XML_URL:
			$this->_set_error_title( _RSSC_PARSE_NOT_READ_XML_URL );
			$this->_set_errors( $this->_refresh_handler->getErrors() );
			return false;

		case RSSC_CODE_PARSE_FAILED:
			$this->_set_error_title( _RSSC_PARSE_FAILED );
			$this->_set_errors( $this->_refresh_handler->getErrors() );
			return false;

		case RSSC_CODE_DB_ERROR:
			$this->_set_error_title( _RSSC_DB_ERROR );
			$this->_set_errors( $this->_refresh_handler->getErrors() );
			return false;

		case RSSC_CODE_REFRESH_ERROR:
		default:
			$this->_set_error_title( _RSSC_REFRESH_ERROR );
			$this->_set_errors( $this->_refresh_handler->getErrors() );
			return false;

	}

	return true;	// dummy
}

function _refresh_link_redirect()
{
	$op_mode = $this->_post->get_post_int('op_mode');

	if ($op_mode)
	{
		$redirect = $this->_redirect_asc;
	}
	else
	{
		$redirect = $this->_redirect_desc;
	}

	$time = $this->_TIME_SUCCESS;
	$msg = _RSSC_REFRESH_LINK_FINISHED;

	if ( $this->_parse_result )
	{
		$time = $this->_TIME_FAILED;
		$msg .= "<br /><br />";
		$msg .= $this->_parse_result;
	}

	redirect_header($redirect, $time, $msg);
}

function _refresh_link_error()
{
	$op_mode = $this->_post->get_post_int('op_mode');

	if ($op_mode)
	{
		$title    = _AM_RSSC_MOD_LINK;
		$op       = 'mod_form';
		$redirect = $this->_redirect_asc;
	}
	else
	{
		$title    = _AM_RSSC_ADD_LINK;
		$op       = 'add_form';
		$redirect = $this->_redirect_desc;
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $title, $op );
	$this->_print_title(    $title );
	$this->_print_token_error(1);
	$this->_print_error(1);

	$lid = $this->_post->get_post_get_int( 'lid' );
	$url = 'link_manage.php?op=mod_form&amp;lid='.$lid;
	echo "<br /><hr /><br />\n";
	echo '- <a href="'.$redirect.'">'._AM_RSSC_LIST_LINK."</a><br />\n";
	echo '- <a href="'.$url.'">'.     _AM_RSSC_MOD_LINK. "</a><br />\n";
}

//---------------------------------------------------------
// check_exist_rssurl
//---------------------------------------------------------
function _check_exist_rssurl()
{
// if force to add
	if ( $this->_post->get_post('force') )
	{	return true;	}

	$mode     = $this->_post->get_post_int( 'mode' );
	$url      = $this->_post->get_post_url( 'url' );
	$rdf_url  = $this->_post->get_post_url( 'rdf_url' );
	$rss_url  = $this->_post->get_post_url( 'rss_url' );
	$atom_url = $this->_post->get_post_url( 'atom_url' );

	$ret1 = $this->_utility->discover_for_manage( $mode, $url, $rdf_url, $rss_url, $atom_url, $this->_sel_rss_atom );
	if ( $ret1 == RSSC_CODE_DISCOVER_FAILED )
	{
		$this->_set_error_title( _RSSC_DISCOVER_FAILED );
		$this->_set_errors( $this->_utility->getErrors() );
	}

	$mode     = $this->_utility->get_xml_mode();
	$rdf_url  = $this->_utility->get_rdf_url();
	$rss_url  = $this->_utility->get_rss_url();
	$atom_url = $this->_utility->get_atom_url();

	$list =& $this->_handler->get_list_by_rssurl( $rdf_url, $rss_url, $atom_url );
	if ( is_array($list) && count($list) )
	{
		$script = 'link_manage.php?op=mod_form&amp;lid=';
		$msg    = $this->_handler->build_error_rssurl_list($list, $script);
		$err    = "<h4>"._RSSC_LINK_ALREADY ."</h4>\n". $msg;
		$this->_set_error_extra( $err );
		return false;
	}

	$_POST['mode']     = $mode;
	$_POST['rdf_url']  = $rdf_url;
	$_POST['rss_url']  = $rss_url;
	$_POST['atom_url'] = $atom_url;
	return true;
}

//---------------------------------------------------------
// view_channel()
//---------------------------------------------------------
function view_channel()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( $this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $this->_LANG_TITLE_MOD, 'mod_form');
	$this->_print_title(    $this->_LANG_TITLE_MOD );
	$this->_form->show_channel( $this->_obj );
	$this->_print_cp_footer();
}

function view_xml()
{
	if ( !$this->_get_obj() )
	{
		redirect_header( $this->_redirect_asc, $this->_TIME_FAILED, $this->_LANG_ERR_NO_RECORD );
		exit();
	}

// xml file
	happy_linux_http_output('pass');
	header($this->_HEADER);
	echo $this->_form->get_xml( $this->_obj );
	exit();
}

// --- class end ---
}

//=========================================================
// class admin_form_link
//=========================================================
class admin_form_link extends happy_linux_form_lib
{
	var $_link_handler;
	var $_xml_handler;
	var $_feed_handler;
	var $_post;
	var $_system;
	var $_html_class;

	var $_conf;

	var $_SIZE_TINY = 15;
	var $_LENGTH_TEXT_SHORT = 300;

	var $_CENSOR_ROWS = 4;
	var $_CENSOR_COLS = 50;

// icon
	var $_DIR_ICON_REL = "images/icons";
	var $_IMG_ID_ICON  = 'rssc_img_icon';
	var $_ICON_NONE    = '---';
	var $_DIR_ICON;
	var $_URL_ICON;
	var $_URL_ICON_WHITE_DOT;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_link()
{
	$this->happy_linux_form_lib();

	$this->_link_handler  =& rssc_get_handler('link', RSSC_DIRNAME);
	$this->_xml_handler   =& rssc_get_handler('xml',  RSSC_DIRNAME);
	$this->_feed_handler  =& rssc_get_handler('feed', RSSC_DIRNAME);
	$this->_post          =& happy_linux_post::getInstance();
	$this->_system        =& happy_linux_system::getInstance();

	$conf_handler =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
	$this->_conf  =  $conf_handler->get_conf();

// icon
	$this->_DIR_ICON = RSSC_ROOT_PATH . '/' . $this->_DIR_ICON_REL;
	$this->_URL_ICON = RSSC_URL       . '/' . $this->_DIR_ICON_REL;
	$this->_URL_ICON_WHITE_DOT = RSSC_URL . '/images/white_dot.png';
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_link();
	}

	return $instance;
}

//---------------------------------------------------------
// show link
//---------------------------------------------------------
function _show(&$obj, $extra=null, $show_mode=0)
{
	echo _AM_RSSC_LINK_DESC."<br /><br />\n";

	echo $this->_build_icon_js();

	$webmap3_flag    = false;
	$webmap3_dirname = $this->_conf['webmap_dirname'] ;
	if ( $this->_check_webmap( $webmap3_dirname ) ) {
		$webmap3_flag = true;
		echo $this->_build_gicon_js();
		echo $this->_build_gicons_js();
	}

	switch ($show_mode) 
	{
		case HAPPY_LINUX_MODE_MOD:
		case HAPPY_LINUX_MODE_MOD_PREVIEW:
			$show_mode  = HAPPY_LINUX_MODE_MOD;
			$form_title = _AM_RSSC_MOD_LINK;
			$op         = 'mod_table';
			$button_val = _HAPPY_LINUX_MODIFY;
			break;

		case HAPPY_LINUX_MODE_ADD:
		case HAPPY_LINUX_MODE_ADD_PREVIEW:
		default:
			$form_title = _AM_RSSC_ADD_LINK;
			$op         = 'add_table';
			$button_val = _ADD;
			break;
	}

	$this->set_obj($obj);

	$lid      = $obj->get('lid');
	$rdf_url  = $obj->get('rdf_url');
	$rss_url  = $obj->get('rss_url');
	$atom_url = $obj->get('atom_url');

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
	
		$list =& $this->_link_handler->get_list_by_rssurl( $rdf_url, $rss_url, $atom_url, $lid );
		if ( is_array($list) && count($list) )
		{
			$script = 'link_manage.php?op=mod_form&amp;lid=';
			echo $this->build_html_highlight( _RSSC_LINK_EXIST_MORE );
			echo "<br /><br />\n";
			echo $this->_link_handler->build_error_rssurl_list($list, $script);
			echo "<br /><br />\n";
		}

		$total_feed = $this->_feed_handler->get_count_by_lid( $lid );

// bug: always 'rssc' directory
		$url_feed = 'feed_list_lid.php?lid='.$lid;

		printf(_AM_RSSC_THERE_ARE_MATCH, $total_feed);
		echo "<br /><br />\n";
		echo $this->build_html_a_href_name($url_feed, _AM_RSSC_FEED_BELONG_LINK);
		echo "<br /><br />\n";
	}

// form start
	echo $this->build_form_begin('link_edit');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_html_input_hidden('lid', $lid);
	}

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_form_table_line(_RSSC_LINK_ID, $lid);
	}

	$ele_uid  = $this->build_obj_text('uid', $this->_SIZE_TINY );
	$ele_uid .= ' ';
	$ele_uid .= $this->build_lib_user_link_uname_by_uid( $obj->get('uid') );
	echo $this->build_form_table_line(_RSSC_USER_ID, $ele_uid);

	$reg_href = '';
	$register =& $this->get_register( $obj );
	if ( is_array($register) )
	{
		$reg_dirname  = $register['dirname'];
		$reg_name     = $register['name'];
		$reg_url      = $register['url'];
		$reg_href     = $this->build_html_a_href_name( $reg_url , $reg_name, '_blank' );
	}

	$ele_mid  = $this->build_obj_text('mid', $this->_SIZE_TINY );
	$ele_mid .= ' '.$reg_href;
	echo $this->build_form_table_line(_RSSC_MOD_ID, $ele_mid);

	echo $this->build_obj_table_text('p1', 'p1', $this->_SIZE_TINY );
	echo $this->build_obj_table_text('p2', 'p2', $this->_SIZE_TINY );
	echo $this->build_obj_table_text('p3', 'p3', $this->_SIZE_TINY );

	echo $this->build_form_table_line(
		_AM_RSSC_LINK_ICON_SEL, $this->_build_ele_icon() );

	if ( $webmap3_flag ) {
		echo $this->build_form_table_line(
			_AM_RSSC_LINK_GICON_SEL, $this->_build_ele_gicon() );
	}

	echo $this->build_obj_table_text(_RSSC_SITE_TITLE, 'title');

	$ele_url = $this->build_edit_url_with_visit('url', $obj->get('url') );
	echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_url);

	$ele_ltype = $this->build_html_input_radio_select('ltype', $obj->get('ltype'), $obj->get_ltype_option() );
	echo $this->build_form_table_line(_RSSC_LTYPE, $ele_ltype);

	echo $this->build_obj_table_text(_RSSC_REFRESH_INTERVAL, 'refresh',  $this->_SIZE_TINY );
	echo $this->build_obj_table_text(_RSSC_HEADLINE_ORDER,   'headline', $this->_SIZE_TINY );

	$ele_enclosure = $this->build_html_input_radio_select('enclosure', $obj->get('enclosure'), $obj->get_enclosure_option() );
	echo $this->build_form_table_line(_RSSC_LINK_ENCLOSURE, $ele_enclosure);

	$cap_censor = $this->build_form_caption(_RSSC_LINK_CENSOR, _AM_RSSC_LINK_CENSOR_DESC);
	echo $this->build_obj_table_textarea( $cap_censor, 'censor', $this->_CENSOR_ROWS, $this->_CENSOR_COLS );

	$ele_plugin_list  = '<a href="'. RSSC_URL .'/plugin_popup.php" target="_blank">';
	$ele_plugin_list .= ' - '._RSSC_PLUGIN_LIST;
	$ele_plugin_list .= '</a>'."<br />\n";
	echo $this->build_form_table_line( '', $ele_plugin_list );

	$cap_pre_plugin = $this->build_form_caption(
		_RSSC_PRE_PLUGIN, _AM_RSSC_PRE_PLUGIN_DESC.'<br />'._AM_RSSC_PLUGIN_DESC_2);
	echo $this->build_obj_table_textarea( $cap_pre_plugin, 'plugin' );

	$cap_post_plugin = $this->build_form_caption(
		_RSSC_POST_PLUGIN, _AM_RSSC_POST_PLUGIN_DESC.'<br />'._AM_RSSC_PLUGIN_DESC_2);
	echo $this->build_obj_table_textarea( $cap_post_plugin, 'post_plugin' );

	$ele_mode = $this->build_html_input_radio_select('mode', $obj->get('mode'), $obj->get_mode_option() );
	echo $this->build_form_table_line(_RSSC_RSS_MODE, $ele_mode);

	$ele_rdf_url = $this->build_edit_url_with_visit('rdf_url', $obj->get('rdf_url') );
	echo $this->build_form_table_line(_RSSC_RDF_URL, $ele_rdf_url);

	$ele_rss_url = $this->build_edit_url_with_visit('rss_url', $obj->get('rss_url') );
	echo $this->build_form_table_line(_RSSC_RSS_URL, $ele_rss_url);

	$ele_atom_url = $this->build_edit_url_with_visit('atom_url', $obj->get('atom_url') );
	echo $this->build_form_table_line(_RSSC_ATOM_URL, $ele_atom_url);

	echo $this->build_obj_table_text(_RSSC_ENCODING,  'encoding');

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		$ele_update  = $this->build_obj_text('updated_unix', $this->_SIZE_TINY );
		$ele_update .= ' ';
		$ele_update .= formatTimestamp( $obj->get('updated_unix') );
		echo $this->build_form_table_line(_RSSC_UPDATED, $ele_update);
	}
	else
	{
		echo $this->build_form_table_line(_RSSC_UPDATED, 0);
	}

	$ele_channel = '';
	$val_channel = $obj->get_channel();
	if ($val_channel)
	{
		$export_channel = var_export($val_channel, TRUE);
		$url_channel    = 'link_manage.php?op=view_channel&amp;lid='.$lid;
		$ele_channel  = $obj->sanitize_format_text_short($export_channel, 's', $this->_LENGTH_TEXT_SHORT);
		$ele_channel .= $this->build_html_a_href_name( $url_channel , _MORE, '_blank' );
	}
	echo $this->build_form_table_line('channel', $ele_channel);

	$ele_xml = '';
	$xml_obj =& $this->_xml_handler->get($lid);
	if ( is_object($xml_obj) )
	{
		$val_xml  = $xml_obj->get_rawurldecode_xml();
		if ($val_xml)
		{
			$url_xml  = 'link_manage.php?op=view_xml&amp;lid='.$lid;
			$ele_xml  = $xml_obj->sanitize_format_text_short($val_xml, 's', $this->_LENGTH_TEXT_SHORT);
			$ele_xml .= $this->build_html_a_href_name( $url_xml , _MORE, '_blank' );
		}
	}

	echo $this->build_form_table_line('xml', $ele_xml);

	if ( $show_mode == 0 )
	{
		$val_force = $this->_post->get_post_int('force');
		$ele_force = $this->build_form_radio_yesno('force', $val_force);
		echo $this->build_form_table_line(_AM_RSSC_LINK_FORCE, $ele_force);
	}

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	if ( $show_mode == HAPPY_LINUX_MODE_MOD )
	{
		$ele_del    = $this->build_html_input_submit('del_table', _DELETE);
		$ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
		echo $this->build_form_table_line('', $ele_del.'  '.$ele_cancel, 'foot', 'foot');
	}

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

function _check_webmap( $webmap_dirname )
{
	$file1 = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api_gicon.php' ;
	$file2 = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api_html.php' ;

	if ( !is_file($file1) ) {
		return false;
	}
	if ( !is_file($file2) ) {
		return false;
	}

	include_once $file1 ;
	include_once $file2 ;

	if ( ! class_exists('webmap3_api_gicon') ) {
		return false;
	}
	if ( ! class_exists('webmap3_api_html') ) {
		return false;
	}

	$this->_gicon_class =& webmap3_api_gicon::getSingleton( $webmap_dirname );
	$this->_html_class  =& webmap3_api_html::getSingleton(  $webmap_dirname );

	return true;
}

function _build_gicon_js()
{
	list($show, $js) = $this->_gicon_class->assign_gicon_js_to_head( false );
	return $js;
}

function _build_gicons_js()
{
	return $this->_gicon_class->get_gicons_js();
}

function _build_ele_gicon()
{
	$id      = $this->_obj->getVar('gicon_id');
	$options = $this->_gicon_class->get_sel_options( true );
	$img_src = $this->_gicon_class->get_image_url( $id ) ;

	$this->_html_class->set_gicon_id( $id );
	$this->_html_class->set_gicon_options( $options );
	$this->_html_class->set_gicon_img_src( $img_src );
	$this->_html_class->set_gicon_select_name(    'gicon_id' );
	$this->_html_class->set_gicon_select_id( 'rssc_gicon_id' );
	$this->_html_class->set_gicon_img_id(    'rssc_gicon_img' );

	$text  = $this->_html_class->build_gicon_select();
	$text .= "<br />\n";
	$text .= $this->_html_class->build_gicon_img();

	return $text;
}

function _build_icon_js()
{
	$url_icon = $this->_URL_ICON;
	$url_none = $this->_URL_ICON_WHITE_DOT;
	$img_id   = $this->_IMG_ID_ICON ;
	$none     = $this->_ICON_NONE ;

$text = <<< EOF
<script type="text/javascript">
//<![CDATA[
function rssc_icon_onchange( obj ) 
{
	var image = "$url_none";

	if ( obj != null ) {
		var index = obj.selectedIndex;
		if ( obj.options[index] != null ) {
			var id = obj.options[index].value;

			if ( id != "$none" ) {
				image = "$url_icon" + "/" + id;
			}
		}
	}

	var element = document.getElementById( "$img_id" );
	if ( element != null  ) {
		element.src = image;
	}
}
//]]>
</script>
EOF;

	return $text;
}

function _build_ele_icon()
{
	$name    = 'icon' ;
	$value   = $this->_obj->getVar($name, 's');
	$options = $this->_system->get_img_list_as_array( $this->_DIR_ICON );
	$extra   = 'onChange="rssc_icon_onchange(this)"';

	$file_icon = $this->_DIR_ICON .'/'. $value;
	$url_icon  = $this->_URL_ICON .'/'. $value;

	$img_src = '';

	if ( $value && file_exists($file_icon) ) {
		$img_src = $url_icon;
	}

	$str  = $this->build_icon_select( $name, $value, $options, $extra );
	$str .= "<br />\n";
	$str .= $this->build_icon_img_tag( $this->_IMG_ID_ICON, $img_src, 'icon' );

	return $str;
}

function build_icon_select( $name, $value, $options, $extra )
{
	$text  = $this->build_html_select_tag_begin( $name, '', false, $extra );
	$text .= $this->build_html_option( $this->_ICON_NONE, $this->_ICON_NONE );

	foreach ($options as $opt_name => $opt_val) {
		$text .= $this->build_html_option_selected( $opt_name, $opt_val, array($value) );
	}

	$text .= $this->build_html_select_tag_end();
	return $text;
}

function build_icon_img_tag( $id, $src, $alt )
{
// sanitize
	$id  = $this->sanitize_text($id);
	$src = $this->sanitize_url($src);
	$alt = $this->sanitize_text($alt);

	$text  = '<img ';
	$text .= 'id="'.$id.'" ';
	$text .= 'src="'.$src.'" ';
	$text .= 'alt="'.$alt.'" ';
	$text .= 'border="0" ';
	$text .= " />\n";

	return $text;
}

function show_refresh_link($lid, $op_mode=0)
{
	switch ($op_mode)
	{
		case 1;
			$location_url = 'link_list.php';
			break;

		case 0;
		default:
			$location_url = 'link_list.php?sortid=1';
			break;
	}

	$arr = array(
		'op'       => 'refresh_link',
		'op_mode'  => $op_mode,
		'lid'      => $lid,
		'rssc_lid' => $lid,
	);

	$form_name      = '';
	$action         = '';
	$submit_name    = 'submit';
	$submit_value   = _HAPPY_LINUX_EXECUTE;
	$cancel_name    = '';
	$cancel_value   = '';
	$location_name  = 'cancel';
	$location_value = _CANCEL;

	$val = $this->build_lib_button_hidden_array( $arr, $form_name, $action, $submit_name, $submit_value, $cancel_name, $cancel_value, $location_name, $location_value, $location_url );
	$text = $this->build_lib_box_style(_RSSC_REFRESH_LINK, _RSSC_REFRESH_LINK_DSC, $val );
	echo $text;
}

function &get_register( &$obj )
{
	$false = false;
	$mid = $obj->get('mid');
	$p1  = $obj->get('p1');

	if ( $mid <= 0 )
	{	return $false;	}

	$module =& $this->_system->get_module_by_mid($mid);
	if ( !is_object($module) )
	{	return $false;	}

	$dirname = $module->getVar('dirname', 'n');
	$name    = $module->getVar('name',    'n');

	$match = null;
	if ( preg_match("/^rssc_headline/", $dirname) )
	{
		$match = 'rssc_headline';
	}
	elseif ( preg_match("/^rssc/", $dirname) )
	{
		$match = 'rssc';
	}
	elseif ( preg_match("/^weblinks/", $dirname) )
	{
		$match = 'weblinks';
	}

	switch ($match)
	{
		case 'rssc_headline':
			$url = XOOPS_URL.'/modules/'.$dirname.'/admin/index.php?op=edit&headline_id='.$p1;
			break;

		case 'weblinks':
			$url = XOOPS_URL.'/modules/'.$dirname.'/admin/link_manage.php?op=mod_form&lid='.$p1;
			break;

		default:
		case 'rssc':
			$url = '';
			break;
	}

	$arr = array(
		'dirname' => $dirname,
		'name'    => $name,
		'url'     => $url,
	);

	return $arr;
}

function show_channel( &$obj )
{
	$title_s = $obj->getVar('title', 's');
	$channel = $obj->get_channel();

	echo "<h4>".$title_s."</h4>\n";
	echo $this->build_form_table_by_array($channel);
	echo "<br />\n";
	echo $this->build_form_button_close_style();

}

function get_xml( &$obj )
{
	$lid = $obj->get('lid');
	$xml = false;
	$xml_obj =& $this->_xml_handler->get($lid);
	if ( is_object($xml_obj) )
	{
		$xml = $xml_obj->get_rawurldecode_xml();
	}
	return $xml;
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_link::getInstance();

$op = $manage->get_op();

switch ($op)
{
	case 'add_table':
		$manage->main_add_table();
		break;

	case 'mod_form':
		$manage->main_mod_form();
		break;

	case 'mod_table':
		$manage->main_mod_table();
		break;

	case 'del_table':
		$manage->main_del_table();
		break;

	case 'addlink':
		$manage->main_addlink();
		break;

	case 'refresh_link':
		$manage->main_refresh_link();
		break;

	case 'view_channel':
		$manage->view_channel();
		break;

	case 'view_xml':
		$manage->view_xml();
		break;

	case 'add_form':
	default:
		$manage->main_add_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>