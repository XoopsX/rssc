<?php
// $Id: rssc_map.php,v 1.1 2011/12/29 14:37:16 ohwada Exp $

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_map') ) 
{

//=========================================================
// class rssc_map
//=========================================================
class rssc_map
{
	var $_map_class ;

	var $_max_image_width  = 120;
	var $_max_image_height = 120;

	var $_DIV_STYLE = 'font-size:80%;' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_map()
{
	// dummy
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_map();
	}
	return $instance;
}

//---------------------------------------------------------
// map
//---------------------------------------------------------
function init( $webmap_dirname )
{
	$file = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api_map.php' ;
	if ( !file_exists($file) ) {
		return false;
	}

	include_once $file ;

	if ( !class_exists( 'webmap_compo_map' ) ) {
		return false;
	}

	$this->_map_class =& webmap_compo_map::getSingleton( $webmap_dirname );

	$this->_map_class->set_show_element( false );
	$this->_map_class->set_map_control(  'large' );
	$this->_map_class->set_type_control( 'default' );
	$this->_map_class->set_use_overview_map_control( true );
	$this->_map_class->set_max_image_width(  $this->_max_image_width  );
	$this->_map_class->set_max_image_height( $this->_max_image_height );

	return true;
}

function fetch_map( $feeds )
{
	$ID = 0;

	foreach ($feeds as $feed) {
		$markers[] = $this->build_marker( $feed );
	}

	$icons = $this->_map_class->get_icons();
	$param = $this->_map_class->build_marker( $ID, $markers, $icons );
	$map   = $this->_map_class->fetch_marker( $param );

	$arr = array(
		'map'         => $map ,
		'element_map' => $param['element_map'] ,
	);
	return $arr;
}

function build_marker( $feed )
{
	$arr = array(
		'latitude'  => $feed['geo_lat'] ,
		'longitude' => $feed['geo_long'] ,
		'icon_id'   => $feed['gicon_id'] ,
		'info'      => $this->build_info( $feed ) ,
	);
	return $arr;
}

function build_info( $feed )
{
	$title_info = '';
	$title_link = '';
	$img_info   = '';
	$img_link   = '';
	$img = '';
	$src = '';

	if ( $feed['link'] ) {
		$title_link = '<a href="'. $feed['link'] .'" target="_blank">';
	}

	$title = $feed['title'] ;

	if ( $feed['media_content_url'] ) {
		$img_link = '<a href="'. $feed['media_content_url'] .'" target="_blank">';
	}

	if ( $feed['media_thumbnail_url'] ) {
		$src = $feed['media_thumbnail_url'];
		list( $width, $height ) =
			$this->_map_class->adjust_image_size( 
				$feed['media_thumbnail_width'], $feed['media_thumbnail_height'] );

	} elseif (  $feed['media_content_url']  && 
	          ( $feed['media_content_medium'] == 'image' )) {
		$src = $feed['media_content_url'];
		list( $width, $height ) =
			$this->_map_class->adjust_image_size( 
				$feed['media_content_width'], $feed['media_content_height'] );
	}

	if ( $src && $width && $height ) {
		$img = '<img src="'. $src .'" width="'. $width .'" height="'. $height .'" border="0" />';
	} elseif ( $src && $width ) {
		$img = '<img src="'. $src .'" width="'. $width .'" border="0" />';
	}

	if ( $title_link && $title ) {
		$title_info = $title_link . $title . '</a><br />' ;
	} elseif ( $title_link ) {
		$title_info = $title_link . 'no title' . '</a><br />' ;
	} elseif ( $title ) {
		$title_info = '<b>'. $title . '</b><br />' ;
	}

	if ( $title_link && $img ) {
		$img_info = $title_link . $img . '</a><br />' ;
	} elseif ( $img_link && $img ) {
		$img_info = $img_link . $img . '</a><br />' ;
	} elseif ( $img_link ) {
		$img_info = $img_link . 'media' . '</a><br />' ;
	} elseif ( $img ) {
		$img_info = $img . '<br />' ;
	}

	$info  = $title_info . $img_info ;
	$info .= '<div style="'. $this->_DIV_STYLE .'">';
	$info .= $this->_map_class->build_summary( $feed['fulltext'] ) ;
	$info .= '</div>';

	return $info;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_info_max( $val )
{
	$this->_map_class->set_info_max($val) ;
}

function set_info_width( $val )
{
	$this->_map_class->set_info_width($val) ;
}

// --- class end ---
}

// === class end ===
}

?>