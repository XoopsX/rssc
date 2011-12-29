<?php
// $Id: lang_main.php,v 1.1 2011/12/29 14:37:06 ohwada Exp $

//================================================================
// RSS Center Module
// use for refresh.php
// 2007-06-01 K.OHWADA
//================================================================

// dir name
$RSSC_DIRNAME = basename( dirname( dirname( __FILE__ ) ) );

global $xoopsConfig;
$XOOPS_LANGUAGE = $xoopsConfig['language'];

// main.php
if ( file_exists(XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php') ) 
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/'.$XOOPS_LANGUAGE.'/main.php';
}
else
{
	include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/english/main.php';
}

include_once XOOPS_ROOT_PATH.'/modules/'.$RSSC_DIRNAME.'/language/compatible.php';

?>