<?php
// $Id: single_link_utf8.php.\040ORIGINAL\0401.10.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

// 2007-10-10 K.OHWADA
// PHP 5.2: Assigning the return value of new by reference
// BUG: Call to undefined method happy_linux_convert_encoding::set_internal_encoding() 

// 2007-06-01 K.OHWADA
// use api/rss_builder.php
// link_basic_handler, xml_basic_handler

// 2006-11-08 K.OHWADA
// use basic_highlight
// use main_link_title_html
// use happy_linux_http_output

// 2006-09-01 K.OHWADA
// use main_search_title_html
// highlight_keyword

// 2006-07-10 K.OHWADA
// use happy_linux_post happy_linux_system
// support podcast

// 2006-06-04 K.OHWADA
// this is new file

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

include 'header.php';
include_once XOOPS_ROOT_PATH.'/class/template.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_parser.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';

$single =& rssc_single_link_utf8::getInstance();

// http start
happy_linux_http_output('pass');
header('Content-Type:text/html; charset=utf-8');

// template
$RSSC_TEMPLATE_NAME = "db:".RSSC_DIRNAME."_single_link_utf8.html";
$xoopsTpl = new XoopsTpl();

$lid   = $single->get_get_lid();
$mode  = $single->get_get_mode();

$single->set_keyword_by_request();
$urlencode = $single->get_keywords_urlencode();

$feed  = array();
$link  = array();
$error = '';
$link_show = 0;
$feed_show = 0;

if ( $single->exists_link($lid) )
{
	$data = $single->get_sanitized_parse_by_lid($lid, $mode);

	$link  = $data['link'];
	$feeds = $data['items'];

	if ( is_array($link) && count($link) )
	{
		$link_show = 1;
		$xoopsTpl->assign('link', $link);
	}

	if ( is_array($feeds) && count($feeds) )
	{
		$feed_show = 1;

		foreach ($feeds as $feed) 
		{
			$xoopsTpl->append('feeds', $feed);
		}
	}
}

$xoopsTpl->assign('xoops_url',        XOOPS_URL );
$xoopsTpl->assign('xoops_charset',    $single->get_encoding() );
$xoopsTpl->assign('xoops_sitename',   $single->get_sitename() );
$xoopsTpl->assign('module_name',      $single->get_module_name() );
$xoopsTpl->assign('is_module_admin',  $single->is_module_admin() );
$xoopsTpl->assign('xoops_themecss',   xoops_getcss() );

$xoopsTpl->assign('lang_single_link',  $single->convert( _RSSC_SINGLE_LINK ) );
$xoopsTpl->assign('lang_no_record',    $single->convert( _HAPPY_LINUX_NO_RECORD ) );
$xoopsTpl->assign('lang_no_feed',      $single->convert( _RSSC_NO_FEED) );
$xoopsTpl->assign('lang_single_link_utf8', $single->convert( _RSSC_SINGLE_LINK_UTF8) );

// podcast
$xoopsTpl->assign('lang_podcast', $single->convert( _RSSC_PODCAST) );
$xoopsTpl->assign('unit_kb',      RSSC_UNIT_KB);

$xoopsTpl->assign('dirname',     RSSC_DIRNAME);
$xoopsTpl->assign('link_show',   $link_show);
$xoopsTpl->assign('feed_show',   $feed_show);
$xoopsTpl->assign('rssc_error',  $error);
$xoopsTpl->assign('lid',   $lid);
$xoopsTpl->assign('mode',  $mode);
$xoopsTpl->assign('link',  $link);
$xoopsTpl->assign('feed',  $feed);
$xoopsTpl->assign('rssc_keywords', $urlencode);

$xoopsTpl->display( $RSSC_TEMPLATE_NAME );

exit();
// --- main end ---

//=========================================================
// class rssc_single_link_utf8
//=========================================================
class rssc_single_link_utf8
{
	var $_link_handler;
	var $_xml_handler;
	var $_conf_handler;
	var $_parser;
	var $_viewer;
	var $_system;
	var $_convert;
	var $_post;
	var $_strings;

	var $ENCODING_LOCAL = _CHARSET;
	var $ENCODING_UTF8  = 'UTF-8';

	var $_lid;
	var $_mode;
	var $_link_obj;

	var $_flag_highlight = false;
	var $_keyword_array  = null;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_single_link_utf8()
{
	$this->_conf_handler  =& rssc_get_handler('config_basic', RSSC_DIRNAME);
	$this->_link_handler  =& rssc_get_handler('link_basic',   RSSC_DIRNAME);
	$this->_xml_handler   =& rssc_get_handler('xml_basic',    RSSC_DIRNAME);

	$this->_parser  =& happy_linux_rss_parser::getInstance();
	$this->_viewer  =& happy_linux_rss_viewer::getInstance();
	$this->_post    =& happy_linux_post::getInstance();
	$this->_system  =& happy_linux_system::getInstance();
	$this->_convert =& happy_linux_convert_encoding::getInstance();
	$this->_strings =& happy_linux_strings::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_single_link_utf8();
	}
	return $instance;
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function exists_link($lid)
{
	$ret = $this->_link_handler->exists_by_lid($lid);
	return $ret;
}

function &get_sanitized_parse_by_lid($lid, $mode)
{
	$false = false;

// BUG: Call to undefined method happy_linux_convert_encoding::set_internal_encoding() 
	happy_linux_internal_encoding( $this->ENCODING_UTF8 );

	$conf =& $this->_conf_handler->get_conf();
	$limit = $conf['main_link_feeds_perlink'];

	$link =& $this->_link_handler->get_link_by_lid($lid);
	if ( !is_array( $link ) )
	{	return $false;	}

	$xml =& $this->_xml_handler->get_xml_by_lid($lid);
	if ( empty($xml) )
	{	return $false;	}

	$encoding =  $link['encoding'];
	$title_s  =  $link['title_s'];

	$link['title_u'] = $this->convert($title_s);

	$this->_parser->set_local_encoding( $this->ENCODING_UTF8 );

	$parse_obj =& $this->_parser->parse_by_xml($xml, $encoding);
	if ( !is_object($parse_obj) )
	{
		return $false;
	}

// PHP 5.2: Assigning the return value of new by reference
	$view_obj =& $this->_viewer->create();
	$view_obj->set_vars( $parse_obj->get_vars() );
	$view_obj->view_format();
	$view_obj->set_is_japanese( $this->_system->is_japanese() );
	$view_obj->set_title_html(     $conf['main_link_title_html'] );
	$view_obj->set_max_title(      $conf['main_link_max_title'] );
	$view_obj->set_content_html(   $conf['main_link_content_html'] );
	$view_obj->set_max_content(    $conf['main_link_max_content'] );
	$view_obj->set_max_summary(    $conf['main_link_max_summary'] );
	$view_obj->set_flag_highlight( $conf['basic_highlight'] );
	$view_obj->set_keyword_array(  $this->_keyword_array );
	$view_obj->view_sanitize();

	$parse_data =& $view_obj->get_vars();
	$items = $parse_data['items'];
	$arr   = array();

	if ( is_array($items) && count($items) )
	{
		$max = count($items);
		if ($max > $limit)
		{
			$max = $limit;
		}

		for ($i=0; $i<$max; $i++)
		{
			$arr[$i] = $items[$i];
		}
	}

	$ret = array();
	$ret['link']  = $link;
	$ret['items'] = $arr;

	return $ret;
}

function get_encoding()
{
	return $this->ENCODING_UTF8;
}

function &convert($text)
{
	$ret = $this->_convert->convert($text, $this->ENCODING_UTF8, $this->ENCODING_LOCAL);
	return $ret;
}

//---------------------------------------------------------
// parameter
//---------------------------------------------------------
function set_highlight($value)
{
	$this->_flag_highlight = (bool)$value;
}

function set_keyword_array($arr)
{
	if ( is_array($arr) && count($arr) )
	{
		$this->_keyword_array = $arr;
	}
}

function set_keyword_by_request()
{
	$this->set_keyword_array( $this->_post->get_get_keyword_array() );
}

function get_keywords_urlencode()
{
	return $this->_strings->urlencode_from_array( $this->_keyword_array );
}

//---------------------------------------------------------
// class system
//---------------------------------------------------------
function is_module_admin()
{
	return $this->_system->is_module_admin();
}

function get_module_name()
{
	return $this->convert( $this->_system->get_module_name('s') );
}

function get_sitename()
{
	return $this->convert( $this->_system->get_sitename() );
}

//---------------------------------------------------------
// class post
//---------------------------------------------------------
function get_get_lid()
{
	return $this->_post->get_get_int('lid');
}

function get_get_mode()
{
	return $this->_post->get_get_int('mode');
}

// --- class end ---
}

?>