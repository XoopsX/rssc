<?php
// $Id: refresh.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

// 2008-01-20 K.OHWADA
// rssc_plugin_base.php

// 2007-10-10 K.OHWADA
// rssc_plugin.php

//================================================================
// RSS Center Module
// use for refresh.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/api/rss_parser.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/functions.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/extract_word.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/kakasi.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/file.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_rss_constant.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/include/rssc_get_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_utility.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_config_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_link_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_xml_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_feed_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_black_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_white_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_word_basic_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_filter_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_log_file.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_plugin.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/class/rssc_refresh_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/plugins/rssc_plugin_base.php';

?>