<?php
// $Id: rss.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

// 2008-02-24 K.OHWADA
// api/rss_builder.php

// 2007-10-10 K.OHWADA
// build()

// 2007-06-01 K.OHWADA
// api/rss_builder.php

// 2007-05-18 K.OHWADA
// happy_linux 0.8

// 2006-09-01 K.OHWADA
// use happy_linux_build_rss
// fuzzy search

// 2006-07-10 K.OHWADA
// use config_basic

// 2006-06-04 K.OHWADA
// use header.php
// move debug view into admin page

//================================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//================================================================

include 'header.php';

include_once RSSC_ROOT_PATH.'/api/rss_builder.php';

$builder =& rssc_build_rssc::getInstance( RSSC_DIRNAME );
$builder->build();

exit();
// --- main end ---

?>