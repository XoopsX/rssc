<?php
// $Id: feed_list.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-06-01 K.OHWADA
// divid to feed_list_class.php

// 2006-09-10 K.OHWADA
// Notice: Only variables should be assigned by reference

// 2006-07-10 K.OHWADA
// use happy_linux_page_frame happy_linux_strings etc
// BUG: pagenavi dont work with lid or link
//   add _get_script_asc() _get_script_desc()

// 2006-06-04 K.OHWADA
// change to contant RSSC_ROOT_PATH

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include 'feed_list_class.php';

//=========================================================
// main
//=========================================================
xoops_cp_header();
rssc_admin_print_header();
rssc_admin_print_menu();

$list =& admin_feed_list::getInstance();
$list->_show();

xoops_cp_footer();
exit();
// --- end of main ---

?>