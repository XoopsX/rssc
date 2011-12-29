<?php
// $Id: refresh.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-06-01 K.OHWADA
// command parameter: limit offset

// 2006-06-04 K.OHWADA
// small change

//=========================================================
// Rss center Module
// this program must be run by Command Line Interface mode
// 2006-01-01 K.OHWADA
//=========================================================

//---------------------------------------------------------
// php -q -f XOOPS/modules/rssc/bin/refresh.php  pass
// php -q -f XOOPS/modules/rssc/bin/refresh.php -pass=pass [ -limit=0 -offset=0 ]
//---------------------------------------------------------

// environment
$RSSC_PATH       = dirname( dirname( __FILE__ ) );
$RSSC_DIRNAME    = basename( $RSSC_PATH );
$XOOPS_ROOT_PATH = dirname( dirname( $RSSC_PATH ) );

// rssc file
include $XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/bin/bin_api.php';

$refresh = new bin_refresh( $RSSC_DIRNAME );
$refresh->refresh();

exit();

?>