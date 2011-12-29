<?php
// $Id: admin_manage_base_class.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-10-10 K.OHWADA
// _check_fill_by_post()

// 2006-09-18 K.OHWADA
// use _check_url_by_post()

// 2006-07-10 K.OHWADA
// use happy_linux_manage happy_linux_strings etc

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// add refresh_link
// suppress notice : Only variable references should be returned by reference

// 2006-01-20 K.OHWADA
// change update table

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class admin_manage_base extends happy_linux_manage
{
// handler
	var $_feed_handler;

// class
	var $_strings;
	var $_system;

// local

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_base()
{
	$this->happy_linux_manage( RSSC_DIRNAME );

	$this->set_list_id_name( 'rssclist_id' );

// handler
	$this->_feed_handler =& rssc_get_handler('feed', RSSC_DIRNAME);

// class
	$this->_strings =& happy_linux_strings::getInstance();
	$this->_system  =& happy_linux_system::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_base();
	}
	return $instance;
}

//---------------------------------------------------------
// main function
//---------------------------------------------------------
function main()
{
	$this->_main();
}

function get_op()
{
	return $this->_main_get_op();
}

function main_default($op)
{
	$this->_main_switch($op);
}

function _print_menu()
{
	rssc_admin_print_header();
	rssc_admin_print_menu();
}

//---------------------------------------------------------
// black & white
//---------------------------------------------------------
function _print_add_form_black_white()
{
	$obj =& $this->_handler->create();
	$obj->set('uid', $this->_system->get_uid() );
	$obj->set('mid', $this->_system->get_mid() );

	$this->_form->_show_add($obj);
	return true;
}

function _main_add_bulk_black_white()
{
	if ( $this->_check_token() && $this->_check_add_bulk_black_white() )
	{
		if ( $this->_exec_add_bulk_black_white() )
		{
			redirect_header($this->_redirect_desc, 1, _AM_RSSC_DBUPDATED);
			exit();
		}
	}

	$this->_print_cp_header();
	$this->_print_bread_op( $this->get_title_add(), 'add_form' );
	$this->_print_title(    $this->get_title_add() );
	$this->_print_token_error(1);
	$this->_print_error(1);
	$this->_print_add_preview_form();
}

function _check_add_bulk_black_white()
{
	$this->_clear_errors();

	if ( $this->_post->get_post_int('reg') ) {
		$this->_check_fill_by_post('urllist', _RSSC_SITE_LINK);
	} else {
		$this->_check_url_by_post('urllist', _RSSC_SITE_LINK);
	}

	return $this->returnExistError();
}

function _exec_add_bulk_black_white()
{
	$reg = $this->_post->get_post_int('reg');

// strip_slashes_gpc
	$urllist  = $this->_post->get_post_text('urllist');

	$url_arr  = $this->_strings->split_nl($urllist);
	$flag_err = false;

	foreach ($url_arr as $url1)
	{
		if ( $reg ) {
			$url2 = $this->_strings->prepare_text($url1, true);
		} else {
			$url2 = $this->_strings->prepare_url($url1, true);
		}

		if ( empty($url2) ) { continue; }

		$obj = $this->_handler->create();
		$obj->assignVars( $_POST );
		$obj->set('url', $url2);

		if ( !$this->_handler->insert($obj) ) 
		{
			$flag_err = true;
			$this->_set_errors( "$url2 :"._AM_RSSC_FAILUPDATE );
			$this->_set_errors( $this->_handler->getErrors() );
		}
	}

	if ( $flag_err ) { return false; }

	return true;
}

function _print_add_preview_form()
{
	$obj =& $this->_handler->create();

// set values just as enter
	$obj->assignVars($_POST);

	if ( isset( $_POST['url'] ) )
	{
		$obj->set('url', $_POST['url'] );
	}
	elseif ( isset( $_POST['urllist'] ) )
	{
		$obj->set('url', $_POST['urllist'] );
	}

	$this->_form->_show_add_preview($obj);
}

//---------------------------------------------------------
// feed handler
//---------------------------------------------------------
function _get_feed_by_fid($fid)
{
	if ($fid <= 0)
	{
		$this->_set_errors( _NO_RECORD );
		return false;
	}

	$feed_obj = $this->_feed_handler->get($fid);

	if ( !is_object($feed_obj) )
	{
		$this->_set_errors( _NO_RECORD );
		return false;
	}

	$feed = $feed_obj->getVarAll();	
	return $feed;
}

// --- class end ---
}

?>