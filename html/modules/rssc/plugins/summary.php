<?php
// $Id: summary.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: summary
// description: make summary from content
// param:
//   0: max_length
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_summary') ) 
{

class rssc_plugin_summary extends rssc_plugin_base
{
	var $_MAX_DEFAULT = 100;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_summary()
{
	$this->rssc_plugin_base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'make summary from content';
}

function usage()
{
	return 'summary ( [max_length] )';
}

function convert()
{
	$max =  intval( $this->get_param_by_num( 0, $this->_MAX_DEFAULT ) );
	$content = $this->get_item_by_key( 'content' );
	if ( $content )
	{
		$this->set_item_by_key( 'content', happy_linux_mb_build_summary( $content, $max ) );
		return true;
	}
	return false;
}

// --- class end ---
}

// === class end ===
}

?>