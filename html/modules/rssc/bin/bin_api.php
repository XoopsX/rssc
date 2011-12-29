<?php
// $Id: bin_api.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-08-01 K.OHWADA
// happy_linux/api/bin.php

// 2007-06-10 K.OHWADA
// api/refresh.php
// bin_file.php

// 2007-05-20 K.OHWADA
// happy_linux global.php

// 2006-09-15 K.OHWADA
// use RSSC_HAPPY_LINUX_VERSION

// 2006-07-08 K.OHWADA
// use class/common/
// use bin_base

// 2006-06-04 K.OHWADA
// use link_basic feed_basic class.database

//================================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//================================================================

// dir name
$RSSC_PATH       = dirname( dirname( __FILE__ ) );
$RSSC_DIRNAME    = basename( $RSSC_PATH );
$XOOPS_ROOT_PATH = dirname( dirname( $RSSC_PATH ) );

// config files ( set XOOPS_ROOT_PATH )
if ( file_exists( $XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/cache/config.php' ) ) 
{
	include_once $XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/cache/config.php';
}
else
{
	die('require cache/config.php');
}

// dir name
if( !defined('RSSC_DIRNAME') )
{
	define('RSSC_DIRNAME', $RSSC_DIRNAME );
}

if( !defined('RSSC_ROOT_PATH') )
{
	define('RSSC_ROOT_PATH', XOOPS_ROOT_PATH.'/modules/'.RSSC_DIRNAME );
}

if( !defined('RSSC_URL') )
{
	define('RSSC_URL', XOOPS_URL.'/modules/'.RSSC_DIRNAME );
}

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if ( !file_exists(XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php') ) 
{
	die('require happy_linux module');
}

include_once RSSC_ROOT_PATH.'/api/refresh.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/bin.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once RSSC_ROOT_PATH.'/include/rssc_version.php';
include_once RSSC_ROOT_PATH.'/class/rssc_refresh_all_handler.php';

// bin files
include_once RSSC_ROOT_PATH.'/bin/bin_refresh_class.php';

// language main
if ( file_exists(RSSC_ROOT_PATH.'/language/'.$xoops_language.'/main.php') ) 
{
	include_once RSSC_ROOT_PATH.'/language/'.$xoops_language.'/main.php';
}
else
{
	include_once RSSC_ROOT_PATH.'/language/english/main.php';
}

// language admin
if ( file_exists(RSSC_ROOT_PATH.'/language/'.$xoops_language.'/admin.php') ) 
{
	include_once RSSC_ROOT_PATH.'/language/'.$xoops_language.'/admin.php';
}
else
{
	include_once RSSC_ROOT_PATH.'/language/english/admin.php';
}

// compatible
include_once RSSC_ROOT_PATH.'/language/compatible.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < RSSC_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.RSSC_HAPPY_LINUX_VERSION.' or later';
	die( $msg );
}

?>