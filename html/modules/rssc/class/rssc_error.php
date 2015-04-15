<?php
// $Id: rssc_error.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2006-07-10 K.OHWADA
// use happy_linux_error

//=========================================================
// Rss Center Module
// 2006-01-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_error') ) 
{

//=========================================================
// class rssc_error
//=========================================================
class rssc_error extends happy_linux_error
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_error()
{
	$this->happy_linux_error();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_error();
	}

	return $instance;
}

// --- class end ---
}

// === class end ===
}

?>