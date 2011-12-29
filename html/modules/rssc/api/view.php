<?php
// $Id: view.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2009-03-01 K.OHWADA
// image_size.php

// 2008-01-20 K.OHWADA
// rssc_plugin_base.php

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
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_viewer.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/image_size.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_feed_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_plugin.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_view_param.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_view_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/plugins/rssc_plugin_base.php';

?>