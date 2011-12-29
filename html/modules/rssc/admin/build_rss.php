<?php
// $Id: build_rss.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2008-02-24 K.OHWADA
// api/rss_builder.php

// 2007-10-10 K.OHWADA
// view()

// 2007-06-01 K.OHWADA
// api/view.php

// 2007-05-18 K.OHWADA
// happy_linux 0.8

// 2006-09-01 K.OHWADA
// use build_rss.php

// 2006-07-10 K.OHWADA
// use config_basic

// 2006-06-04 K.OHWADA
// this is new file
// move from rss.php

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

include 'admin_header.php';

include_once RSSC_ROOT_PATH.'/api/rss_builder.php';

$search_handler =& rssc_get_handler( 'search', RSSC_DIRNAME );
$conf_handler   =& rssc_get_handler( 'config_basic', RSSC_DIRNAME );
$builder        =& rssc_build_rssc::getInstance( RSSC_DIRNAME );

$conf =& $conf_handler->get_conf();
$max_limit = $conf['main_search_perpage'];
$min       = $conf['main_search_min'];

$start = $search_handler->get_get_start();
$limit = $search_handler->get_get_limit();
$mode  = $search_handler->get_get_rss_mode();

if ($limit <= 0)
{
	$limit = $max_limit;
}

$feeds =& $search_handler->getLatest($limit, $start);

$builder->set_view_goto_title( _HAPPY_LINUX_CONF_RSS_MANAGE );
$builder->set_view_goto_url( RSSC_URL.'/admin/build_menu.php' );
$builder->view( $mode, $feeds );

exit();
// --- main end ---

?>