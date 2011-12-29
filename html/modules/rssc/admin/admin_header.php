<?php
// $Id: admin_header.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2008-01-20 K.OHWADA
// rssc_plugin.php
// check happy_linux version in the beginning

// 2007-11-11 K.OHWADA
// memory.php

// 2007-06-01 K.OHWADA
// rssc_xml_handler.php rssc_word_handler.php

// 2006-09-10 K.OHWADA
// use RSSC_HAPPY_LINUX_VERSION

// 2006-07-10 K.OHWADA
// require happy_linux module

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include '../../../include/cp_header.php';

//---------------------------------------------------------
// system
//---------------------------------------------------------

// admin check
if ( !is_object($xoopsUser) ) 
{
	die('you must login');
}

if ( !$xoopsUser->isAdmin( $xoopsModule->mid() ) )
{
	die('you are not admin');
}

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
if( !defined('RSSC_DIRNAME') )
{
	define('RSSC_DIRNAME', $xoopsModule->dirname() );
}

if( !defined('RSSC_ROOT_PATH') )
{
	define('RSSC_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/'.RSSC_DIRNAME );
}

if( !defined('RSSC_URL') )
{
	define('RSSC_URL', XOOPS_URL.'/modules/'.RSSC_DIRNAME );
}

include_once RSSC_ROOT_PATH.'/include/rssc_version.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if ( !file_exists(XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php') ) 
{
	xoops_cp_header();
	xoops_error( 'require happy_linux module' );
	xoops_cp_footer();
	exit();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < RSSC_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.RSSC_HAPPY_LINUX_VERSION.' or later';
	xoops_cp_header();
	xoops_error( $msg );
	xoops_cp_footer();
	exit();
}

// start execution time
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
$happy_linux_time =& happy_linux_time::getInstance();

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once RSSC_ROOT_PATH.'/api/manage.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/gtickets.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/memory.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/admin_menu.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/system.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/convert_encoding.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/html.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/form_lib.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/page_frame.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/manage.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once RSSC_ROOT_PATH.'/class/rssc_link_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_xml_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_feed_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_black_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_white_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_word_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_plugin.php';
include_once RSSC_ROOT_PATH.'/plugins/rssc_plugin_base.php';
include_once RSSC_ROOT_PATH.'/admin/admin_function.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

if ( file_exists(RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php') ) 
{
	include_once RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/main.php';
}
else
{
	include_once RSSC_ROOT_PATH.'/language/english/main.php';
}

if ( file_exists(RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/modinfo.php') ) 
{
	include_once RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/modinfo.php';
}
else
{
	include_once RSSC_ROOT_PATH.'/language/english/modinfo.php';
}

// compatible
include_once RSSC_ROOT_PATH.'/language/compatible.php';

?>