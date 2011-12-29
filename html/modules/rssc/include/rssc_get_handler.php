<?php
// $Id: rssc_get_handler.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2006-07-10 K.OHWADA
// use happy_linux_get_handler

// 2006-06-04 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// --- rssc_get_handler begin ---
if( !function_exists( 'rssc_get_handler' ) ) 
{

function &rssc_get_handler($name=null, $module_dir=null)
{
	$ret =& happy_linux_get_handler($name, $module_dir, 'rssc');
	return $ret;
}

// --- rssc_get_handler end ---
}

?>