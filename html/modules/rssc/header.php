<?php
// $Id: header.php,v 1.2 2012/04/08 23:42:20 ohwada Exp $

// 2012-04-02 K.OHWADA
// rssc_map.php

// 2009-02-20 K.OHWADA
// blocks.php

// 2008-01-20 K.OHWADA
// check happy_linux version in the beginning

// 2007-11-11 K.OHWADA
// memory.php

// 2007-06-01 K.OHWADA
// api/view.php

// 2006-09-10 K.OHWADA
// use RSSC_HAPPY_LINUX_VERSION

// 2006-07-10 K.OHWADA
// require happy_linux module

// 2006-06-04 K.OHWADA
// this is new file

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

// system files
include '../../mainfile.php';

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
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error( 'require happy_linux module' );
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < RSSC_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.RSSC_HAPPY_LINUX_VERSION.' or later';
	include XOOPS_ROOT_PATH.'/header.php';
	xoops_error( $msg );
	include XOOPS_ROOT_PATH.'/footer.php';
	exit();
}

// start execution time
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
$happy_linux_time =& happy_linux_time::getInstance( true );

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once RSSC_ROOT_PATH.'/api/view.php';
include_once RSSC_ROOT_PATH.'/class/rssc_icon.php';
include_once RSSC_ROOT_PATH.'/class/rssc_block_map.php';
include_once RSSC_ROOT_PATH.'/class/rssc_map.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_builder.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/language.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/locate.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/multibyte.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/memory.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/highlight.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/post.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/remote_file.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/convert_encoding.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/pagenavi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/search.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/image_size.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// system search
if ( file_exists(XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/search.php') ) {
	include_once XOOPS_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/search.php';
} else {
	include_once XOOPS_ROOT_PATH.'/language/english/search.php';
}

// blocks.php
if ( file_exists(RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/blocks.php') ) {
	include_once RSSC_ROOT_PATH.'/language/'.$XOOPS_LANGUAGE.'/blocks.php';
} else {
	include_once RSSC_ROOT_PATH.'/language/english/blocks.php';
}

// compatible
include_once RSSC_ROOT_PATH.'/language/compatible.php';

?>