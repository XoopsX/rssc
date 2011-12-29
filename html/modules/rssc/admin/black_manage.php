<?php
// $Id: black_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// jump_feed
// set_flag_execute_time()

// 2007-06-01 K.OHWADA
// api/rss_parser.php

// 2006-09-18 K.OHWADA
// show bread crumb
// use XoopsGTicket
// use _check_url_by_post()

// 2006-07-08 K.OHWADA
// move class admin_manage_black from admin_manage_class.php
// move class admin_form_black   from admin_form_class.php

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_parser.php';

include_once RSSC_ROOT_PATH.'/admin/admin_manage_base_class.php';
include_once RSSC_ROOT_PATH.'/admin/admin_form_black_white.php';

//=========================================================
// class black manage
//=========================================================
class admin_manage_black extends admin_manage_base
{
// handler
	var $_parser;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_black()
{
	$this->admin_manage_base();

	$this->set_handler( 'black', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'bid' );
	$this->set_form_class( 'admin_form_black' );
	$this->set_script(   'black_manage.php' );
	$this->set_redirect( 'black_list.php', 'black_list.php?sortid=1' );
	$this->set_title( _AM_RSSC_ADD_BLACK, _AM_RSSC_MOD_BLACK, _AM_RSSC_DEL_BLACK );
	$this->set_flag_execute_time( true );

// handler
	$this->_parser =& happy_linux_rss_parser::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_black();
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
	return $this->_print_add_form_black_white();
}

//---------------------------------------------------------
// main_add_table()
//---------------------------------------------------------
function main_add_table()
{
	$this->_main_add_table( true );
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

	if ( $this->_post->get_post_int('reg') ) {
		$this->_check_fill_by_post('url', _RSSC_SITE_LINK);
	} else {
		$this->_check_url_by_post('url', _RSSC_SITE_LINK);
	}

	return $this->returnExistError();
}

function _exec_mod_table()
{
	$url1 = $this->_post->get_post_text('url');

	if ( $this->_post->get_post_int('reg') ) {
		$url2 = $this->_strings->prepare_text($url1, true);
	} else {
		$url2 = $this->_strings->prepare_url($url1, true);
	}

	$this->_modid = $this->_get_post_get_id();
	$this->_obj->assignVars( $_POST );
	$this->_obj->set('url', $url2);

	if ( !$this->_handler->update( $this->_obj ) ) 
	{
		$this->_set_errors( $this->_LANG_FAIL_MOD );
		$this->_set_errors( $this->_handler->getErrors() );
		return false;
	}
	return true;
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function main_del_table()
{
	$this->_main_del_table( true );
}

//---------------------------------------------------------
// main_add_bulk()
//---------------------------------------------------------
function main_add_bulk()
{
	$this->_main_add_bulk_black_white();
}

//---------------------------------------------------------
// main_addlist()
//---------------------------------------------------------
function main_addlist()
{
	$this->_print_cp_header();
	$this->_print_menu();
	$this->_print_title( _AM_RSSC_ADD_BLACK );

	if ( !$this->_print_add_list() )
	{
		$this->_print_error(1);
	}
}

function _print_add_list()
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
		$title = $parse_obj->get_channel_by_key('title');
		$link  = $parse_obj->get_channel_by_key('link');
		$site_title = $title;
		$site_link  = $link;
	}
	else
	{
		$title = $feed_title;
		$link  = $feed_link;
		$site_title = '';
		$site_link  = '';
	}

	$memo  = '';
	$memo .= $feed['site_title']."\n";
	$memo .= $feed['site_link']."\n";
	$memo .= $feed_title."\n";
	$memo .= $feed_link."\n";
	$memo .= $site_title."\n";
	$memo .= $site_link."\n";

	$obj =& $this->_handler->create();

// set values just as enter
	$obj->assignVars( $feed );

	$obj->set('url',   $link );
	$obj->set('title', $title );
	$obj->set('memo',  $memo );

	$this->_form->_show_add($obj);
	return true;
}

// --- class end ---
}


//=========================================================
// class admin_form_black
//=========================================================
class admin_form_black extends admin_form_black_white
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_black()
{
	$this->admin_form_black_white();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_black();
	}

	return $instance;
}

//---------------------------------------------------------
// show black & white
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	$this->_id_name        = 'bid';
	$this->_form_title_add = _AM_RSSC_ADD_BLACK;
	$this->_form_title_mod = _AM_RSSC_MOD_BLACK;

	$this->_jump_feed = 'feed_list_bid.php?bid='. $obj->get('bid');

	$this->_show_black_white($obj, $extra, $mode);
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_black::getInstance();

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

	case 'add_bulk':
		$manage->main_add_bulk();
		break;

	case 'addlist':
		$manage->main_addlist();
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