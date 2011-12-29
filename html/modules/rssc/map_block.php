<?php
// $Id: map_block.php,v 1.1 2011/12/29 14:37:04 ohwada Exp $

//================================================================
// Rss center Module
// 2009-02-20 K.OHWADA
//================================================================

include '../../mainfile.php';

//---------------------------------------------------------
// rssc
//---------------------------------------------------------
$DIRNAME = basename( dirname( __FILE__ ) ) ;
$MODULE_DIR = XOOPS_ROOT_PATH.'/modules/'.$DIRNAME ;
include_once $MODULE_DIR.'/blocks/block_latest.php';

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];
$file_lang = $MODULE_DIR.'/language/'.$XOOPS_LANGUAGE.'/blocks.php';
$file_eng  = $MODULE_DIR.'/language/english/blocks.php';
if ( file_exists( $file_lang ) ) {
	include_once $file_lang;
} else {
	include_once $file_eng;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
$options = array( $DIRNAME );
$block = b_rssc_show_gmap( $options );

echo "<html><head>\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset='. _CHARSET .'">'."\n";
echo "<title>RSS map</title>";
echo "</head>\n<body>\n";
echo $block['map'] ;
echo "</body></html>\n";
exit();

?>