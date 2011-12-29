<?php
// $Id: manage.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

//================================================================
// RSS Center Module
// use for view_handler.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/rss_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/time.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/error.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/strings.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/object_handler.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_error.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_handler.php';

?>