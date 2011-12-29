<?php
// $Id: strip_tags.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: strip_tags
// description: strip html tags in the content
// param:
//   0: allowable_tags, ex) '<img><a>'
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_strip_tags') ) 
{

class rssc_plugin_strip_tags extends rssc_plugin_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_strip_tags()
{
	$this->rssc_plugin_base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'strip html tags in the content';
}

function usage()
{
	return 'strip_tags ( [allowable_tags] )';
}

function convert()
{
	$content = $this->get_item_by_key( 'content' );
	if ( $content )
	{
		$this->set_item_by_key( 'content', $this->_strip_tags( $content ) );
		return true;
	}
	return false;
}

function _strip_tags( $content )
{
	$allowable_tags = $this->get_param_by_num(0);
	if ( $allowable_tags )
	{
		return strip_tags( $content, $allowable_tags );
	}
	return strip_tags( $content );
}

// --- class end ---
}

// === class end ===
}

?>