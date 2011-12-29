<?php
// $Id: update_manage.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// rssc v0.70
// rssc_admin_print_footer()

// 2006-07-10 K.OHWADA
// rssc v0.30

//================================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//================================================================

include 'admin_header.php';

xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

echo "<h4>"._AM_RSSC_UPDATE_MANAGE."</h4>\n";
echo "<a href='xoopsheadline100_to_rssc070.php'>"._AM_RSSC_IMPORT_XOOPSHEADLINE."</a><br /><br />\n";
echo "<a href='weblinks097_to_rssc070.php'>"._AM_RSSC_IMPORT_WEBLINKS."</a><br /><br />\n";

rssc_admin_print_footer();
xoops_cp_footer();
exit();

?>