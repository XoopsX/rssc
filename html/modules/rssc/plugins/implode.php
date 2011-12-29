<?php
// $Id: implode.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: implode
// description: implode all feeds to one content
// param:
//   0: implode_adderss, ex) 'webmaster@exsample.com'
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_implode') ) 
{

class rssc_plugin_implode extends rssc_plugin_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_implode()
{
	$this->rssc_plugin_base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'implode all feeds to one content';
}

function usage()
{
	return 'implode';
}

function execute( $items )
{
	$text = '';

	foreach ( $items as $input )
	{
		$this->set_item_array( $input );

		$text .= $this->get_item_by_key( 'title' );
		$text .= "\n";
		$text .= $this->get_item_by_key( 'link' );
		$text .= "\n";
		$text .= $this->get_item_by_key( 'content' );
		$text .= "\n\n";
	}

	$this->clear_item_array();
	$this->set_item_by_key( 'content', $text );

	$this->clear_plural_item_array();
	$this->add_plural_item( $this->get_item_array() );

	return $this->get_plural_item_array();
}

// --- class end ---
}

// === class end ===
}

?>