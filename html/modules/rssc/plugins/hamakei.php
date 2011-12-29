<?php
// $Id: hamakei.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: hamakei
// description: georss and mediarss for hamakei
// param: none
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_hamakei') ) 
{

class rssc_plugin_hamakei extends rssc_plugin_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_hamakei()
{
	$this->rssc_plugin_base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'georss and mediarss for hamakei';
}

function convert()
{
	$url       = $this->get_item_by_key( 'enclosure_url' );
	$type      = $this->get_item_by_key( 'enclosure_type' );
	$length    = $this->get_item_by_key( 'enclosure_length' );
	$item_orig = $this->get_item_by_key( 'item_orig' );

// mediarss
	if ( $url && ( $type == 'image/jpeg')) {
		$this->set_item_by_key( 'media_content_url',      $url);
		$this->set_item_by_key( 'media_content_type',     $type);
		$this->set_item_by_key( 'media_content_filesize', $length);
		$this->set_item_by_key( 'media_content_medium',   'image');
	}

// georss
	if ( isset($item_orig['dc']['coverage']) ) {
		$arr = explode( ',', $item_orig['dc']['coverage'] );
		if ( isset($arr[0]) && isset($arr[1]) ) {
			$long = floatval($arr[0]);
			$lat  = floatval($arr[1]);
			if (($lat != 0)&&($long != 0)) {
				$this->set_item_by_key( 'geo_lat',  $lat);
				$this->set_item_by_key( 'geo_long', $long);
			}
		}
	}

	return true ;
}

// --- class end ---
}

// === class end ===
}

?>