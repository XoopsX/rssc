<?php
// $Id: admin_header_config.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

//=========================================================
// RSS Center Module
// 2007-11-11 K.OHWADA
//=========================================================

include 'admin_header.php';

//---------------------------------------------------------
// happy_linux
//---------------------------------------------------------
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_base_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_define_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/config_store_handler.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/module_install.php';

//---------------------------------------------------------
// whatsnew
//---------------------------------------------------------
include_once RSSC_ROOT_PATH.'/class/rssc_config_define.php';
include_once RSSC_ROOT_PATH.'/class/rssc_config_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_install.php';

//include_once RSSC_ROOT_PATH.'/admin/admin_table_class.php';
include_once RSSC_ROOT_PATH.'/admin/admin_config_class.php';

?>