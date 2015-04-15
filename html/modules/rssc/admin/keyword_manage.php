<?php
// $Id: keyword_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-111-01 K.OHWADA
// set_flag_execute_time()
// _KEYWORD => _RSSC_KEYWORD

// 2007-06-01 K.OHWADA
// link_xml_handler
// include file under local language

// 2006-09-18 K.OHWADA
// show bread crumb
// use _check_fill_by_post()

// 2006-07-10 K.OHWADA
// move class admin_manage_keyword from admin_manage_class.php
// use happy_linux_form happy_linux_convert_encoding
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once RSSC_ROOT_PATH.'/admin/admin_manage_base_class.php';


//=========================================================
// class keyword manage
//=========================================================
class admin_manage_keyword extends admin_manage_base
{
// handler, class
	var $_list;
	var $_convert;
	var $_system;

	var $_MODE = RSSC_C_MODE_RSS;	// rss
	var $_REFRESH_INTERVAL = 3600;	// 1 hours

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_keyword()
{
	$this->admin_manage_base();

	$this->set_handler( 'link_xml', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'lid' );
	$this->set_form_class( 'admin_form_keyword' );
	$this->set_script(   'keyword_manage.php' );
	$this->set_redirect( 'link_list.php', 'link_list.php?sortid=1' );
	$this->set_title( _AM_RSSC_ADD_KEYWORD, _AM_RSSC_MOD_LINK, _AM_RSSC_DEL_LINK );
	$this->set_flag_execute_time( true );

// handler, class
	$this->_convert     =& happy_linux_convert_encoding::getInstance();
	$this->_system      =& happy_linux_system::getInstance();

	$this->_list_id = 1;

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_keyword();
	}
	return $instance;
}

//---------------------------------------------------------
// check enviroment
//---------------------------------------------------------
function file_exists()
{
	$language = $this->_system->get_language();

	if ( file_exists(RSSC_ROOT_PATH.'/language/'.$language.'/site_list.php') ) 
	{
		include_once RSSC_ROOT_PATH.'/language/'.$language.'/site_list.php';
		$this->_list =& rssc_site_list::getInstance();
		return true;
	}
	return false;
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
	$obj = $this->_handler->create();
	$obj->setVar( 'uid', $this->_system->get_uid() );
	$obj->setVar( 'mid', $this->_system->get_mid() );
	$obj->setVar( 'mode', $this->_MODE );
	$obj->setVar( 'refresh', $this->_REFRESH_INTERVAL );
	$obj->setVar( 'ltype', RSSC_C_LINK_LTYPE_SEARCH );	// rss search site

	$this->_form->_show_add($obj);
	return true;
}

//---------------------------------------------------------
// main_add_keyword()
//---------------------------------------------------------
function main_add_keyword()
{
	if ( !$this->_check_token() || !$this->_check_add_keyword() )
	{
		$this->_print_add_keyword_preview();
		exit();
	}

	if ( $this->_exec_add_keyword() )
	{
		redirect_header($this->_redirect_desc, 1, _AM_RSSC_DBUPDATED);
		exit();
	}
	else
	{
		$this->_print_add_keyword_db_error();
		exit();
	}

}

function _check_add_keyword()
{
	$this->_clear_errors();

// check fill
	$this->_check_fill_by_post('keyword', _RSSC_KEYWORD);

	return $this->returnExistError();
}

function _exec_add_keyword()
{
	$this->_clear_errors();

	foreach( $this->_list->get_site_list() as $site )
	{
		$obj = $this->_handler->create();
		$obj->set_vars_keyword( $site );
		$newid = $this->_handler->insert($obj);
		if ( !$newid ) 
		{
			$this->_set_errors( $this->_handler->getErrors() );
		}
	}

	return $this->returnExistError();
}

function _print_add_keyword_preview()
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ADD_KEYWORD, 'add_form' );
	$this->_print_title(    _AM_RSSC_ADD_KEYWORD );
	$this->_print_token_error(1);
	$this->_print_error(1);
	$this->_print_add_preview_form();
}

function _print_add_keyword_db_error()
{
	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ADD_KEYWORD, 'add_form');
	xoops_error("DB Error");
	$this->_print_error(1);
	$this->_print_cp_footer();
}

// --- class end ---
}

//=========================================================
// class admin_form_keyword
//=========================================================
class admin_form_keyword extends happy_linux_form
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_keyword()
{
	$this->happy_linux_form();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_keyword();
	}

	return $instance;
}

//---------------------------------------------------------
// show keyword
//---------------------------------------------------------
function _show($obj, $extra=null, $mode=0)
{
	$form_title = _AM_RSSC_ADD_KEYWORD;
	$op         = 'add_keyword';
	$button_val = _ADD;

	$this->set_obj($obj);

// form start
	echo $this->build_form_begin('link_edit');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);
	echo $this->build_html_input_hidden('ltype', $obj->get('ltype') );

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	echo $this->build_obj_table_text(_RSSC_USER_ID, 'uid');
	echo $this->build_obj_table_text(_RSSC_MOD_ID,  'mid');
	echo $this->build_obj_table_text('p1', 'p1');
	echo $this->build_obj_table_text('p2', 'p2');
	echo $this->build_obj_table_text('p3', 'p3');

	echo $this->build_obj_table_text(_RSSC_KEYWORD, 'keyword');
	echo $this->build_obj_table_text(_RSSC_REFRESH_INTERVAL, 'refresh');

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_keyword::getInstance();

if ( !$manage->file_exists() )
{
	print_notice();
	exit();
}

$op = $manage->get_op();

switch ($op)
{
	case 'add_keyword':
		$manage->main_add_keyword();
		break;

	default:
		$manage->main_add_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---


//---------------------------------------------------------
// function
//---------------------------------------------------------
function print_notice()
{
	xoops_cp_header();
	rssc_admin_print_header();
	rssc_admin_print_menu();

?>
<br />
<font color='red'>NOT support in your language</font><br />
<br />
There are the RSS search site which carries out RSS feeds of the search results, such as <br />
In English<br />
- <a href="http://blogsearch.google.com/" target="_blank">http://blogsearch.google.com/</a><br />
<br />
In Japanese<br />
- <a href="http://sf.livedoor.com/" target="_blank">http://sf.livedoor.com/</a><br />
<br />
I dont know same site in your language. <br />
If you know, please teach me.<br />
Webmaster of <a href="http://linux2.ohwada.net/" target="_blank">Happy Linux</a><br />
<br />
<?php

	xoops_cp_footer();
}

?>