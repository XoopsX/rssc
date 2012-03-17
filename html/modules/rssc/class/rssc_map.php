<?php
// $Id: rssc_map.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// webmap3_api_map

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
	var $_conf;

	var $_map_div_id = '';
	var $_map_func   = '';
	var $_info_max   = 0;
	var $_info_width = 0;

	var $_DIV_STYLE   = 'font-size:80%;' ;
	var $_ELE_ID_NAME = "rssc_map";

	var $_DIRNAME = '';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_map( $dirname )
{
	$this->_DIRNAME = $dirname;
	$this->_conf = $this->get_conf( $dirname );
}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_map( $dirname );
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

	if ( !class_exists( 'webmap3_api_map' ) ) {
		return false;
	}

	$this->_map_class =& webmap3_api_map::getSingleton( $webmap_dirname );

	$this->_map_class->init();
	$this->_map_class->set_latitude(  $this->_conf['webmap_latitude'] );
	$this->_map_class->set_longitude( $this->_conf['webmap_longitude'] );
	$this->_map_class->set_zoom(      $this->_conf['webmap_zoom'] );
	$this->_map_class->set_overview_map_control( true );
	$this->_map_class->set_overview_map_control_opened( true );

	$this->_info_max   = _C_WEBMAP3_MAP_INFO_MAX;
	$this->_info_width = _C_WEBMAP3_MAP_INFO_WIDTH;

	return true;
}

function fetch_map( $feeds )
{
// head
	$this->_map_class->assign_google_map_js_to_head();
	$this->_map_class->assign_map_js_to_head();
	$this->_map_class->assign_gicon_array_to_head();

// markers
	foreach ($feeds as $feed) {
		$markers[] = $this->build_marker( $feed );
	}

// map
	$this->_map_class->set_map_div_id( $this->_map_div_id ) ;
	$this->_map_class->set_map_func(   $this->_map_func ) ;

	$param = $this->_map_class->build_markers( $markers );
	         $this->_map_class->fetch_markers_head( $param );
	$map   = $this->_map_class->fetch_body_common(  $param );
	$block = $this->_map_class->fetch_block_common( $param );

	$arr = array(
		'map_div_id' => $this->_map_div_id ,
		'map_js'     => $map ,
		'block_js'   => $block ,
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

	$this->_map_class->set_info_max(   $this->_info_max ) ;
	$this->_map_class->set_info_width( $this->_info_width ) ;

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
// handler for block
//---------------------------------------------------------
function get_conf( $DIRNAME )
{
	$db =& Database::getInstance();
	$table_config = $db->prefix( $DIRNAME.'_config' );

	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $db->query($sql, 0, 0);
	if ( !$res ) {
		return false;
	}

	$conf = array();
	while ( $row = $db->fetchArray($res) ) {
		$conf[ $row['conf_name'] ] = $row['conf_value'];
	}
	return $conf;
}

//---------------------------------------------------------
// set param
//---------------------------------------------------------
function set_map_div_id( $v )
{
	$this->_map_div_id = $v;
}

function set_map_func( $v )
{
	$this->_map_func = $v;
}

function set_info_max( $val )
{
	$this->_info_max = $val ;
}

function set_info_width( $val )
{
	$this->_info_width = $val ;
}

// --- class end ---
}

// === class end ===
}

?>