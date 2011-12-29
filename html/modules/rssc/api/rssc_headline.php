<?php
// $Id: rssc_headline.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2007-06-01 K.OHWADA
// api/view.php api/refresh.php

// 2006-09-15 K.OHWADA
// not use rssc_link_exist_handler.php
// use happy_linux/include/version.php

// 2006-07-10 K.OHWADA
// this is new file

//=========================================================
// RSS Center Module
// API for rssc_hedline
// 2006-07-10 K.OHWADA
//=========================================================

// dir name
$RSSC_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
if ( !file_exists(XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php') ) 
{
	die('require happy_linux module');
}

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/version.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/view.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/refresh.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/manage.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/api/lang_main.php';

include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_version.php';

// check happy_linux version
if ( HAPPY_LINUX_VERSION < RSSC_HAPPY_LINUX_VERSION ) 
{
	$msg = 'require happy_linux module v'.RSSC_HAPPY_LINUX_VERSION.' or later';
	die( $msg );
}

?>