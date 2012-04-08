<?php
// $Id: rssc_block_map.php,v 1.1 2012/04/08 23:44:40 ohwada Exp $

//=========================================================
// Rss Center Module
// 2012-04-02 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_block_map') ) 
{

//=========================================================
// class rssc_block_map
//=========================================================
class rssc_block_map
{
	var $_map_class;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_block_map( $dirname )
{
	// dummy
}

function &getSingleton( $dirname )
{
	static $singletons;
	if ( !isset( $singletons[ $dirname ] ) ) {
		$singletons[ $dirname ] = new rssc_block_map( $dirname );
	}
	return $singletons[ $dirname ];
}

//---------------------------------------------------------
// block
//---------------------------------------------------------
function build_map_block( $param )
{
	$dirname     = $param['dirname'] ;
	$map_div_id  = $param['map_div_id'] ;
	$map_func    = $param['map_func'] ;
	$feeds       = $param['feeds'] ;
	$conf        = $param['conf'] ;

	$webmap3_dirname = $conf['webmap_dirname'];
	$latitude        = $conf['webmap_latitude'];
	$longitude       = $conf['webmap_longitude'];
	$zoom            = $conf['webmap_zoom'];
	$max_title       = $conf['block_map_max_title'];
	$info_max        = $conf['block_map_info_max'];
	$info_width      = $conf['block_map_info_width'];

	if ( ! $this->check_webmap_dirname( $webmap3_dirname ) ) {
		return false;
	}

	$show_map = false;

	$this->_map_class =& $this->get_map_class( $webmap3_dirname );
	if ( ! is_object($this->_map_class) ) {
		return false;
	}

	$this->_map_class->init();

	$this->_map_class->set_latitude(  $latitude );
	$this->_map_class->set_longitude( $longitude );
	$this->_map_class->set_zoom(      $zoom );

	$this->_map_class->set_title_length( $max_title ) ;
	$this->_map_class->set_info_max(     $info_max ) ;
	$this->_map_class->set_info_width(   $info_width ) ;

// head
	$this->_map_class->assign_google_map_js_to_head();
	$this->_map_class->assign_map_js_to_head();
	$this->_map_class->assign_gicon_array_to_head();

	$markers = array();
	if ( is_array($feeds) && count($feeds) ){
		foreach ($feeds as $feed) {
			if ( $this->check_latlng_by_feed( $feed ) ) {
				$show_map = true;
				$markers[] = $this->build_marker( $feed );
			}
		}
	}

// map
	$this->_map_class->set_map_div_id( $map_div_id ) ;
	$this->_map_class->set_map_func(   $map_func ) ;

	$m_param = $this->_map_class->build_markers( $markers );
	           $this->_map_class->fetch_markers_head( $m_param );

	return $show_map;
}

function check_webmap_dirname( $dirname )
{
	if ( $dirname == '' ) {
		return false;
	}
	if ( $dirname == '-' ) {
		return false;
	}
	if ( $dirname == '---' ) {
		return false;
	}
	return true;
}

function &get_map_class( $webmap_dirname )
{
	$false = false;

	$file = XOOPS_ROOT_PATH.'/modules/'. $webmap_dirname .'/include/api.php' ;
	if ( !file_exists($file) ) {
		return $false;
	}

	include_once $file ;

	if ( !class_exists( 'webmap3_api_map' ) ) {
		return $false;
	}

	$map_class =& webmap3_api_map::getSingleton( $webmap_dirname );
	return $map_class;
}

function build_marker( $feed )
{
	return $this->_map_class->build_single_marker(
		$feed['geo_lat'], 
		$feed['geo_long'], 
		$this->build_info( $feed ), 
		$feed['gicon_id'] );
}

function build_info( $feed )
{
	$title_info = '';
	$title_link = '';
	$img_info   = '';
	$img_link   = '';

	$title = $feed['title'] ;

	if ( $feed['link'] ) {
		$title_link = '<a href="'. $this->sanitize( $feed['link'] ) .'" target="_blank">';
	}

	if ( $feed['media_content_url'] ) {
		$img_link = '<a href="'. $this->sanitize( $feed['media_content_url'] ) .'" target="_blank">';
	}

	$img = $this->build_info_img( $feed );

	if ( $title_link && $title ) {
		$title_info = $title_link . $this->build_info_title( $title ) . '</a><br />' ;
	} elseif ( $title_link ) {
		$title_info = $title_link . 'no title' . '</a><br />' ;
	} elseif ( $title ) {
		$title_info  = $this->build_info_title( $title ) .'<br />';
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
	$info .= '<span style="font-size:80%">';
	$info .= $this->_map_class->build_summary( $feed['fulltext'] ) ;
	$info .= '</span>';

	return $info;
}

function build_info_title( $title )
{
	$str  = '<span style="font-weight:bold">';
	$str .= $this->_map_class->build_title_short( $title );
	$str .= '</span>';
	return $str;
}

function build_info_img( $feed )
{
	$img = '';
	$src = '';

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
		$img = '<img src="'. $this->sanitize( $src ) .'" width="'. intval( $width ) .'" height="'. intval( $height ) .'" border="0" />';
	} elseif ( $src && $width ) {
		$img = '<img src="'. $this->sanitize( $src ) .'" width="'. intval( $width ) .'" border="0" />';
	}

	return $img;
}

function check_latlng_by_feed( $feed )
{
	return $this->check_lat_lng( 
		$feed['geo_lat'], $feed['geo_long'] );
}

function check_lat_lng( $latitude, $longitude )
{
	$lat = intval( $latitude  * 1000000 );
	$lng = intval( $longitude * 1000000 );

	if ( $lat != 0 ) { return true; }
	if ( $lng != 0 ) { return true; }
	return false;
}

function sanitize( $str ) 
{
	return htmlspecialchars( $str, ENT_QUOTES );
}

// --- class end ---
}

// === class end ===
}

?>