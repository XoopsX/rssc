<?php
// $Id: rssc_headline_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

// 2007-06-01 K.OHWADA
// link_basic_handler

// 2006-07-10 K.OHWADA
// use happy_linux_error

// 2006-06-29 K.OHWADA
// Fatal error: Call to a member function on a non-object

// 2006-06-04 K.OHWADA
// this is new file
// move from rssc_refresh_handler.php

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_headline_handler') ) 
{

//=========================================================
// class rssc_headline_handler
//=========================================================
class rssc_headline_handler extends happy_linux_error
{
// handler
	var $_link_handler;
	var $_refresh_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_headline_handler( $dirname )
{
	$this->happy_linux_error();

// handler
	$this->_link_handler    =& rssc_get_handler('link_basic', $dirname);
	$this->_refresh_handler =& rssc_get_handler('refresh',    $dirname);
}

//---------------------------------------------------------
// refresh headline links
//---------------------------------------------------------
function refresh_headline($limit=0, $start=0)
{
	$this->_clear_errors();

	$lid_arr = $this->_link_handler->get_headline_lids($limit, $start);

// refresh
	foreach ($lid_arr as $lid) 
	{
		if ( !$this->_refresh_handler->refresh($lid) )
		{
// Fatal error: Call to a member function on a non-object
			$this->_set_errors( $this->_refresh_handler->getErrors() );
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// get headline links
//---------------------------------------------------------
function &get_headline_links($limit=0, $start=0)
{
	$links =& $this->_link_handler->get_headlines($limit, $start);
	return $links;
}

// --- class end ---
}

// === class end ===
}

?>