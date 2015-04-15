<?php
// $Id: feed_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2009-02-20 K.OHWADA
// geo_lat

// 2008-02-24 K.OHWADA
// _URL_SIZE

// 2007-11-01 K.OHWADA
// use php_self
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// main_mod_all()
// rssc_feed_basic_handler.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_feed from admin_manage_class.php
// move class admin_form_feed   from admin_form_class.php
// change make_xxx to build_xxx
// corresponding to podcast
//   add enclosure

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once RSSC_ROOT_PATH.'/class/rssc_feed_basic_handler.php';
include_once RSSC_ROOT_PATH.'/admin/admin_manage_base_class.php';

//=========================================================
// class feed manage
//=========================================================
class admin_manage_feed extends admin_manage_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_feed()
{
	$this->admin_manage_base();

	$this->set_handler( 'feed', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'fid' );
	$this->set_form_class( 'admin_form_feed' );
	$this->set_script(   'feed_manage.php' );
	$this->set_redirect( 'feed_list.php', 'feed_list.php?sortid=1' );
	$this->set_title( _AM_RSSC_ADD_FEED, _AM_RSSC_MOD_FEED, _AM_RSSC_DEL_FEED );
	$this->set_list_id_name( 'rssc_feed_id' );
	$this->set_flag_execute_time( true );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_feed();
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
	$obj->set('uid', $this->_system->get_uid() );
	$obj->set('mid', $this->_system->get_mid() );

	$this->_print_form($obj, null, $this->_MODE_INSERT);
	return true;
}

//---------------------------------------------------------
// main_add_table()
//---------------------------------------------------------
function main_add_table()
{
	$this->_main_add_table( true );
}

function _check_add_table()
{
	$this->_clear_errors();
	$this->_check_add_mod();
	return $this->returnExistError();
}

function _check_add_mod()
{
// check fill
	$this->_check_fill_by_post( 'site_title', _RSSC_SITE_TITLE);
	$this->_check_url_by_post(  'site_link',  _RSSC_SITE_LINK);
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
	$this->_main_mod_table( true );
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
// main_mod_all()
//---------------------------------------------------------
function main_mod_all()
{
	$del     = $this->_post->get_post('del_all');
	$mod     = $this->_post->get_post('mod_all');
	$request = $this->_post->get_post('request_uri');
	$url     = 'feed_list.php';

	if ( $request )
	{
		$this->set_redirect_mod_all( $request );
		$this->set_redirect_del_all( $request );
	}

	if ( $mod )
	{
		$this->_main_mod_all( true );
	}
	elseif ( $del )
	{
		$this->_main_del_all( true );
	}
	else
	{
		redirect_header( $url, 3, 'invalid submit name' );
	}
}

function &_get_obj_mod_all()
{
// set act = 0
	$this->_obj->setVar('act', 0);
	return $this->_obj;
}

//---------------------------------------------------------
// main_del_all()
//---------------------------------------------------------
function main_del_all()
{
	$this->_main_del_all( true );
}

// --- class end ---
}

//=========================================================
// class admin_form_feed
//=========================================================
class admin_form_feed extends happy_linux_form
{
	var $_LENGTH_TEXT_SHORT = 500;
	var $_URL_SIZE          =  70;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_feed()
{
	$this->happy_linux_form();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_feed();
	}

	return $instance;
}

//---------------------------------------------------------
// show feed
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	switch ($mode) 
	{
		case HAPPY_LINUX_MODE_MOD:
		case HAPPY_LINUX_MODE_MOD_PREVIEW:
			$mode       = HAPPY_LINUX_MODE_MOD;
			$form_title = _AM_RSSC_MOD_FEED;
			$op         = 'mod_table';
			$button_val = _HAPPY_LINUX_MODIFY;
			break;

		case HAPPY_LINUX_MODE_ADD:
		case HAPPY_LINUX_MODE_ADD_PREVIEW:
		default:
			$form_title = _AM_RSSC_ADD_FEED;
			$op         = 'add_table';
			$button_val = _ADD;
			break;
	}

	$this->set_obj($obj);

// form start
	echo $this->build_form_begin('feed_edit');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_html_input_hidden('fid', $obj->get('fid'));
	}

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_form_table_line('feed id', $obj->get('fid'));
	}

	$act_opt = $obj->get_act_option();
	$ele_act = $this->build_html_input_radio_select('act', $obj->get('act'), $act_opt );
	echo $this->build_form_table_line(_RSSC_FEED_ACT, $ele_act);

	echo $this->build_obj_table_text(_RSSC_LINK_ID, 'lid');
	echo $this->build_obj_table_text(_RSSC_USER_ID, 'uid');
	echo $this->build_obj_table_text(_RSSC_MOD_ID,  'mid');
	echo $this->build_obj_table_text('p1', 'p1');
	echo $this->build_obj_table_text('p2', 'p2');
	echo $this->build_obj_table_text('p3', 'p3');

	echo $this->build_obj_table_text(_RSSC_SITE_TITLE, 'site_title');

	$ele_sitelink = $this->build_edit_url_with_visit(
		'site_link', $obj->get('site_link'), $this->_URL_SIZE );
	echo $this->build_form_table_line(_RSSC_SITE_LINK, $ele_sitelink);

	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_TITLE, 'title');

	$ele_link = $this->build_edit_url_with_visit(
		'link', $obj->get('link'), $this->_URL_SIZE, 0 );
	echo $this->build_form_table_line(_HAPPY_LINUX_VIEW_LINK, $ele_link);

	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_ATOM_ID,   'entry_id');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_RSS_GUID,  'guid');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_PUBLISHED, 'published_unix');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_UPDATED,   'updated_unix');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_CATEGORY,  'category');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_AUTHOR_NAME,  'author_name');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_AUTHOR_URI,   'author_uri');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_AUTHOR_EMAIL, 'author_email');
	echo $this->build_obj_table_text(_RSSC_MODE_CONT,    'mode_cont');

// enclosure
	$ele_enclosure_url = $this->build_edit_url_with_visit(
		'enclosure_url', $obj->get('enclosure_url'), $this->_URL_SIZE );
	echo $this->build_form_table_line(_HAPPY_LINUX_VIEW_ENCLOSURE_URL, $ele_enclosure_url);

	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_ENCLOSURE_TYPE,   'enclosure_type');
	echo $this->build_obj_table_text(_HAPPY_LINUX_VIEW_ENCLOSURE_LENGTH, 'enclosure_length');

// geo
	echo $this->build_obj_table_text(_RSSC_FEED_GEO_LAT,   'geo_lat');
	echo $this->build_obj_table_text(_RSSC_FEED_GEO_LONG,  'geo_long');

// media
	$ele_media_content_url = $this->build_edit_url_with_visit(
		'media_content_url', $obj->get('media_content_url'), $this->_URL_SIZE );
	echo $this->build_form_table_line(_RSSC_FEED_MEDIA_CONTENT_URL, $ele_media_content_url);

	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_TYPE,   'media_content_type');
	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_MEDIUM, 'media_content_medium');
	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_WIDTH,  'media_content_width');
	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_CONTENT_HEIGHT, 'media_content_height');

	$ele_media_thumbnail_url = $this->build_edit_url_with_visit(
		'media_thumbnail_url', $obj->get('media_thumbnail_url'), $this->_URL_SIZE );
	echo $this->build_form_table_line(_RSSC_FEED_MEDIA_THUMBNAIL_URL, $ele_media_thumbnail_url);

	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_THUMBNAIL_WIDTH,  'media_thumbnail_width');
	echo $this->build_obj_table_text(_RSSC_FEED_MEDIA_THUMBNAIL_HEIGHT, 'media_thumbnail_height');

	$val_rows = $obj->get_export_raws();
	$ele_raws = $this->sanitize_format_text_short($val_rows, 's', $this->_LENGTH_TEXT_SHORT);
	echo $this->build_form_table_line(_RSSC_RAWS, $ele_raws);

	$ele_content = $obj->get_var_text_short('content', 's', $this->_LENGTH_TEXT_SHORT);
	echo $this->build_form_table_line(_HAPPY_LINUX_VIEW_CONTENT, $ele_content);

	$ele_search = $obj->get_var_text_short('search', 's', $this->_LENGTH_TEXT_SHORT);
	echo $this->build_form_table_line(_RSSC_SEARCH_FIELD, $ele_search);

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		$ele_del    = $this->build_html_input_submit('del_table', _DELETE);
		$ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
		echo $this->build_form_table_line('', $ele_del.'  '.$ele_cancel, 'foot', 'foot');
	}

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_feed::getInstance();

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

	case 'mod_all':
		$manage->main_mod_all();
		break;

	case 'add_form':
	default:
		$manage->main_add_form();
		break;
}

exit();
// --- end of main ---

?>