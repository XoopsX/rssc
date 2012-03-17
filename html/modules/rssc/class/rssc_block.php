<?php
// $Id: rssc_block.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// rssc_map::getInstance( $rssc_dirname )

// 2009-05-17 K.OHWADA
// not show blog site title
// 2009-04-03 K.OHWADA
// BUG: not valid headline params

//=========================================================
// RSS Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_block') ) 
{

//=========================================================
// class rssc_block
//=========================================================
class rssc_block
{
	var $_db;

	var $_is_japanese;

	var $_MAX_WIDTH  = 120;
	var $_MAX_HEIGHT = 120;
	var $_FLAG_ZERO  = true;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_block()
{
	$this->_db =& Database::getInstance();
	$this->_is_japanese = happy_linux_is_japanese() ;
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_block();
	}
	return $instance;
}

//---------------------------------------------------------
// show latest feeds
//---------------------------------------------------------
function show_latest( $DIRNAME )
{
	$block = array();
	$block['dirname']      = $DIRNAME;
	$block['lang_more']    = _BL_RSSC_MORE;
	$block['lang_podcast'] = _BL_RSSC_PODCAST;
	$block['unit_kb']      =  BL_RSSC_UNIT_KB;

// config data
	$conf_data = $this->get_conf( $DIRNAME );
	if ( !$conf_data ) {
		return $block;
	}

	$show_icon = $conf_data['block_latest_show_icon'] ;
	$icon_list = null ;

	$feed_param = array(
		'dirname'  => $DIRNAME ,
		'order'    => $conf_data['block_latest_order'] ,
		'limit'    => $conf_data['block_latest_perpage'] ,
		'future'   => $conf_data['basic_future_days'] ,
		'flag_map' => false ,
	);

	$build_param = array(
		'max_title'   => $conf_data['block_latest_max_title'] ,
		'max_summary' => $conf_data['block_latest_max_summary'] ,
		'max_content' => $conf_data['block_latest_max_content'] ,
	);

	$rows = $this->get_feed_latest( $feed_param );
	if ( !is_array($rows) ) {
		return $block;
	}

	$feeds = $this->build_feeds( $rows, $build_param );

	$tpl_param = array(
		'dirname'     => $DIRNAME ,
		'feeds'       => $feeds ,
		'show_icon'   => $show_icon ,
		'show_thumb'  => $conf_data['block_latest_show_thumb'] ,
		'show_site'   => $conf_data['block_latest_show_site'] ,
		'mode_date'   => $conf_data['block_latest_mode_date'] ,
		'num_content' => $conf_data['block_latest_num_content'] ,
	);

	$feed_list = $this->fetch_tpl_feed_list( $tpl_param );

	if ( $show_icon ) {
		$icon_list  = $this->get_icon_list( $DIRNAME );
	}

	$block['feed_list'] = $feed_list;
	$block['icon_list'] = $icon_list;

	return $block;
}

//---------------------------------------------------------
// show latest feeds on google map
//---------------------------------------------------------
function show_map( $DIRNAME )
{
	$block = array();
	$block['dirname']      = $DIRNAME;
	$block['lang_more']    = _BL_RSSC_MORE;
	$block['lang_podcast'] = _BL_RSSC_PODCAST;
	$block['unit_kb']      =  BL_RSSC_UNIT_KB;

// config data
	$conf_data = $this->get_conf( $DIRNAME );
	if ( !$conf_data ) {
		return $block;
	}

	$feed_param = array(
		'dirname'  => $DIRNAME ,
		'order'    => $conf_data['block_map_order'] ,
		'limit'    => $conf_data['block_map_perpage'] ,
		'future'   => $conf_data['basic_future_days'] ,
		'flag_map' => true ,
	);

	$build_param = array(
		'max_title'   => $conf_data['block_map_max_title'] ,
		'max_summary' => 0 ,
		'max_content' => 0 ,
	);

	$rows = $this->get_feed_latest( $feed_param );
	if ( !is_array($rows) ) {
		return $block;
	}

	$feeds = $this->build_feeds( $rows, $build_param );

	$map_div_id = $DIRNAME.'_map_block_0' ;
	$map_func   = $DIRNAME.'_load_map_block_0';

	$webmap_param = array(
		'dirname'        => $DIRNAME ,
		'map_div_id'     => $map_div_id ,
		'map_func'       => $map_func ,
		'webmap_dirname' => $conf_data['webmap_dirname'] ,
		'info_max'       => $conf_data['block_map_info_max'] ,
		'info_width'     => $conf_data['block_map_info_width'] ,
		'feeds'          => $feeds ,
	);

	$map_param = $this->get_map( $webmap_param );
	if ( !is_array($map_param) ) {
		$block['error'] = 'no map' ;
		return $block ;
	}

	$block['show_map']   = true;
	$block['feeds']      = $feeds;
	$block['map_div_id'] = $map_div_id ;
	$block['block_js']   = $map_param['block_js'] ;

	return $block ;
}

//---------------------------------------------------------
// show headline
//---------------------------------------------------------
function show_headline( $DIRNAME )
{
	$block = array();
	$block['dirname']      = $DIRNAME;
	$block['lang_more']    = _BL_RSSC_MORE;
	$block['lang_podcast'] = _BL_RSSC_PODCAST;
	$block['unit_kb']      =  BL_RSSC_UNIT_KB;

// config data
	$conf_data = $this->get_conf( $DIRNAME );
	if ( !$conf_data ) {
		return $block;
	}

	$build_param = array(
		'max_title'   => $conf_data['block_headline_max_title'],
		'max_summary' => $conf_data['block_headline_max_summary'],
		'max_content' => $conf_data['block_headline_max_content'],
	);

	$link_param = array(
		'dirname' => $DIRNAME ,
		'limit'   =>  $conf_data['block_headline_links_perpage'] ,
	);

// BUG: not valid headline params
	$tpl_param = array(
		'dirname'     => $DIRNAME ,
		'show_thumb'  => $conf_data['block_headline_show_thumb'] ,
		'show_icon'   => false ,
		'show_site'   => false ,
		'mode_date'   => $conf_data['block_headline_mode_date'] ,
		'num_content' => $conf_data['block_headline_num_content'] ,
	);

	$link_rows = $this->get_link_headline( $link_param );
	if ( !is_array($link_rows) ) {
		return  $block;
	}

	$links = array();

	foreach ( $link_rows as $link_row ) 
	{
		$lid = intval( $link_row['lid'] );

		$feed_list = null;

		$feed_param = array(
			'dirname'  => $DIRNAME ,
			'lid'      => $lid ,
			'order'    => $conf_data['block_headline_order'] ,
			'limit'    => $conf_data['block_headline_feeds_perlink'] ,
			'future'   => $conf_data['basic_future_days'] ,
		);

		$feed_rows = $this->get_feed_lid( $feed_param );
		if ( is_array($feed_rows) ) {
			$tpl_param['feeds'] = $this->build_feeds( $feed_rows, $build_param );
			$feed_list = $this->fetch_tpl_feed_list( $tpl_param );
		}

		$link = array();
		$link['lid']       = $lid;
		$link['enclosure'] = intval( $link_row['enclosure'] );
		$link['url_s']     = $this->sanitize_url(  $link_row['url'] );
		$link['title_s']   = $this->sanitize( $link_row['title'] );
		$link['feed_list'] = $feed_list;

		$links[] = $link;
	}

	list( $show_short, $show_middle, $show_long ) = 
		$this->build_date( $conf_data['block_headline_mode_date'] );

	$block['links']       = $links;

	return $block;
}

//---------------------------------------------------------
// show blog
//---------------------------------------------------------
function show_blog( $DIRNAME )
{
	$block = array();
	$block['dirname']      = $DIRNAME;
	$block['lang_more']    = _BL_RSSC_MORE;
	$block['lang_podcast'] = _BL_RSSC_PODCAST;
	$block['unit_kb']      =  BL_RSSC_UNIT_KB;

// config data
	$conf_data = $this->get_conf( $DIRNAME );
	if ( !$conf_data ) {
		return $block;
	}

	$feeds = null ;
	$lid   = $conf_data['block_blog_lid'];

// no link id
	if ($lid == 0) {
		$block['feed_show']  = false;
		$block['lang_error'] = _BL_RSSC_NO_LINK_ID;
		return $block;
	}

	$link_param = array(
		'dirname' => $DIRNAME ,
		'lid'     => $lid ,
	);

	$feed_param = array(
		'dirname'  => $DIRNAME ,
		'lid'      => $lid ,
		'order'    => $conf_data['block_blog_order'] ,
		'limit'    => $conf_data['block_blog_perpage'] ,
		'future'   => $conf_data['basic_future_days'] ,
	);

	$build_param = array(
		'max_title'   => $conf_data['block_blog_max_title'],
		'max_summary' => $conf_data['block_blog_max_summary'],
		'max_content' => $conf_data['block_blog_max_content'],
	);

	$link_row = $this->get_link_row( $link_param );

	if ( !is_array($link_row) ) {
		$block['feed_show']  = false;
		$block['lang_error'] = _BL_RSSC_NO_LINK_ID;
		return $block;
	}

// not show blog site title
	$site_title = $link_row['title'] ;
	$site_link  = $link_row['url'] ;

	$link = array();
	$link['enclosure'] = intval( $link_row['enclosure'] );

	$feed_rows = $this->get_feed_lid( $feed_param );
	if ( is_array($feed_rows) ) {
		$feeds = $this->build_feeds( $feed_rows, $build_param );

	} else {
		$block['feed_show']  = false;
		$block['lang_error'] = _BL_RSSC_NO_FEED;
		return $block;
	}

	if ( empty($site_title) && isset($feeds[0]['site_title']) ) {
		$site_title = $feeds[0]['site_title'];
	}
	if ( empty($site_link) && isset($feeds[0]['site_link']) ) {
		$site_link = $feeds[0]['site_link'];
	}

	$tpl_param = array(
		'dirname'     => $DIRNAME ,
		'feeds'       => $feeds ,
		'show_thumb'  => $conf_data['block_blog_show_thumb'] ,
		'show_icon'   => false ,
		'show_site'   => false ,
		'mode_date'   => $conf_data['block_blog_mode_date'] ,
		'num_content' => $conf_data['block_blog_num_content'] ,
	);

	$feed_list = $this->fetch_tpl_feed_list( $tpl_param );

	$block['feed_show']    = true;
	$block['feed_list']    = $feed_list;
	$block['site_title_s'] = $this->sanitize( $site_title );
	$block['site_link_s']  = $this->sanitize( $site_link );
	$block['link']         = $link;

	return $block;
}

//---------------------------------------------------------
// handler
//---------------------------------------------------------
function get_conf( $DIRNAME )
{
	$table_config = $this->_db->prefix( $DIRNAME.'_config' );

	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $this->_db->query($sql, 0, 0);
	if ( !$res ) {
		return false;
	}

	$conf = array();
	while ( $row = $this->_db->fetchArray($res) ) {
		$conf[ $row['conf_name'] ] = $row['conf_value'];
	}
	return $conf;
}

function get_feed_latest( $param )
{
	$dirname     = $param['dirname'] ;
	$limit       = $param['limit'] ;
	$conf_future = $param['future'] ;
	$conf_order  = $param['order'] ;
	$flag_map    = $param['flag_map'] ;

	$table_feed = $this->_db->prefix( $dirname.'_feed' );
	$table_link = $this->_db->prefix( $dirname.'_link' );
	$order      = $this->build_order(  $conf_order );
	$future     = $this->build_future( $conf_future );

	$sql  = 'SELECT f.*, l.enclosure as enclosure_mode, l.icon, l.gicon_id FROM ';
	$sql .= $table_feed.' f, ';
	$sql .= $table_link.' l ';
	$sql .= ' WHERE f.act=1';
	$sql .= ' AND f.updated_unix <'.  $future;
	$sql .= ' AND f.published_unix <'.$future;
	$sql .= ' AND f.lid=l.lid';

	if ( $flag_map ) {
		$sql .= ' AND (( f.geo_lat != 0 ) OR ( f.geo_long != 0 )) ';
	}

	$sql .= ' ORDER BY '.$order;

	$res = $this->_db->query($sql, $limit, 0);
	if ( !$res ) {
		return false;
	}

	$rows = array();
	while ($row = $this->_db->fetchArray($res)) {
		$rows[] = $row;
	}
	return $rows;
}

function get_feed_lid( $param )
{
	$dirname     = $param['dirname'] ;
	$lid         = $param['lid'] ;
	$limit       = $param['limit'] ;
	$conf_future = $param['future'] ;
	$conf_order  = $param['order'] ;

	$table_feed = $this->_db->prefix( $dirname.'_feed' );
	$order      = $this->build_order(  $conf_order );
	$future     = $this->build_future( $conf_future );

	$sql  = 'SELECT * FROM '.$table_feed;
	$sql .= ' WHERE lid='.intval($lid);
	$sql .= ' AND updated_unix <'.  $future;
	$sql .= ' AND published_unix <'.$future;
	$sql .= ' AND act=1';
	$sql .= ' ORDER BY '.$order;

	$res = $this->_db->query($sql, $limit, 0);

	$rows = array();
	while ($row = $this->_db->fetchArray($res)) {
		$rows[] = $row;
	}
	return $rows;
}

function get_link_row( $param )
{
	$dirname = $param['dirname'] ;
	$lid     = $param['lid'] ;

	$table_link = $this->_db->prefix( $dirname.'_link' );

	$sql = 'SELECT * FROM '.$table_link.' WHERE lid='.$lid;
	$res = $this->_db->query($sql);
	if ( !$res ) {
		return false;
	}

	return $this->_db->fetchArray($res);
}

function get_link_headline( $param )
{
	$dirname = $param['dirname'] ;
	$limit   = $param['limit'] ;

	$table_link = $this->_db->prefix( $dirname.'_link' );

	$sql = 'SELECT * FROM '.$table_link.' WHERE headline > 0 ORDER BY headline ASC';

	$res = $this->_db->query($sql, $limit, 0);
	if ( !$res ){
		return false;
	}

	$rows = array();
	while ($row = $this->_db->fetchArray($res)) {
		$rows[] = $row;
	}
	return $rows;
}

//---------------------------------------------------------
// icon list
//---------------------------------------------------------
function get_icon_list( $DIRNAME )
{
	include_once XOOPS_ROOT_PATH.'/modules/'. $DIRNAME  .'/class/rssc_icon.php';
	$icon_class =& rssc_icon::getInstance();
	return  $icon_class->build_template_icon_list( $DIRNAME );
}

//---------------------------------------------------------
// map
//---------------------------------------------------------
function get_map( $param )
{
	$rssc_dirname   = $param['dirname'] ;
	$webmap_dirname = $param['webmap_dirname'] ;
	$map_div_id     = $param['map_div_id'] ;
	$map_func       = $param['map_func'] ;
	$info_max       = $param['info_max'] ;
	$info_width     = $param['info_width'] ;
	$feeds          = $param['feeds'] ;

	include_once XOOPS_ROOT_PATH.'/modules/'. $rssc_dirname  .'/class/rssc_map.php';
	$map_class =& rssc_map::getInstance( $rssc_dirname );

	$ret = $map_class->init( $webmap_dirname );
	if ( !$ret ) {
		return false ;
	}

	$map_class->set_map_div_id( $map_div_id ) ;
	$map_class->set_map_func(   $map_func ) ;
	$map_class->set_info_max(   $info_max ) ;
	$map_class->set_info_width( $info_width ) ;

	return $map_class->fetch_map( $feeds );
}

//---------------------------------------------------------
// template
//---------------------------------------------------------
function fetch_tpl_feed_list( $param )
{
	$dirname     = $param['dirname'] ;
	$feeds       = $param['feeds'] ;
	$show_thumb  = isset($param['show_thumb'])  ? (bool)$param['show_thumb'] : false;
	$show_icon   = isset($param['show_icon'])   ? (bool)$param['show_icon']  : false;
	$show_site   = isset($param['show_site'])   ? (bool)$param['show_site']  : false;
	$mode_date   = isset($param['mode_date'])   ? intval($param['mode_date'])   : 0;
	$num_content = isset($param['num_content']) ? intval($param['num_content']) : 0;

	$show_li     = !$show_icon;
	$template    = XOOPS_ROOT_PATH .'/modules/'. $dirname  .'/templates/parts/rssc_block_feed_list.html' ;

	list( $show_short, $show_middle, $show_long ) = 
		$this->build_date( $mode_date );

	$tpl = new XoopsTpl();
	$tpl->assign('xoops_url',   XOOPS_URL );
	$tpl->assign('dirname',     $dirname );
	$tpl->assign('show_thumb',  $show_thumb );
	$tpl->assign('show_icon',   $show_icon );
	$tpl->assign('show_site',   $show_site );
	$tpl->assign('show_li',     $show_li );
	$tpl->assign('show_short',  $show_short );
	$tpl->assign('show_middle', $show_middle );
	$tpl->assign('show_long',   $show_long );
	$tpl->assign('num_content', $num_content );
	$tpl->assign('max_width',  $this->_MAX_WIDTH );

	foreach ($feeds as $feed) {
		$tpl->append('feeds', $feed);
	}

	return $tpl->fetch( $template );
}

//---------------------------------------------------------
// utility
//---------------------------------------------------------
function build_feeds( $rows, $param )
{
	$feeds = array();
	foreach ( $rows as $row ) {
		$feeds[] = $this->build_single_feed( $row, $param );
	}
	return $feeds;
}

function build_single_feed( $row, $param )
{
	$max_title   = $param['max_title'];
	$max_summary = $param['max_summary'];
	$max_content = $param['max_content'];

	$is_japanese  = $this->_is_japanese ;
	$thumb_url    = null ;
	$thumb_width  = 0 ;
	$thumb_height = 0 ;

	$site_title     = $row['site_title'];
	$site_link      = $row['site_link'];
	$title          = $row['title'];
	$link           = $row['link'];
	$content        = $row['content'];
	$published_unix = intval( $row['published_unix'] );
	$updated_unix   = intval( $row['updated_unix'] );

	$enclosure_mode = isset( $row['enclosure_mode'] ) ? intval( $row['enclosure_mode'] ) : 0;
	$icon     = isset( $row['icon'] )     ? $row['icon']               : null;
	$gicon_id = isset( $row['gicon_id'] ) ? intval( $row['gicon_id'] ) : 0;

	$site_title = happy_linux_mb_build_summary( $site_title, $max_title, '...', $is_japanese );
	$site_title = $this->substitute_title($site_title);

	$title = happy_linux_mb_build_summary( $title, $max_title, '...', $is_japanese );
	$title = $this->substitute_title($title);

	$summary = happy_linux_mb_build_summary( $content, $max_summary, '...', $is_japanese );

// unlimit , when $max_content = -1
	if ( $max_content == 0 ) {
		$content = '';
	} elseif ( $max_content > 0 ) {
		$content = happy_linux_mb_build_summary($content, $max_content);
	}

	if ( $row['media_thumbnail_url'] ) {
		$thumb_url = $row['media_thumbnail_url'] ;
		list( $thumb_width, $thumb_height) = 
			$this->adjust_size(
				$row['media_thumbnail_width'], $row['media_thumbnail_height'] ); 

	} elseif ( $row['media_content_url'] && ($row['media_content_medium'] == 'image') ) {
		$thumb_url = $row['media_content_url'] ;
		list( $thumb_width, $thumb_height) = 
			$this->adjust_size( 
				$row['media_content_width'], $row['media_content_height'] ); 
	}

	$feed = array(
		'fid'  => intval( $row['fid'] ),
		'lid'  => intval( $row['lid'] ),
		'uid'  => intval( $row['uid'] ),
		'mid'  => intval( $row['mid'] ),
		'p1'   => intval( $row['p1'] ),
		'p2'   => intval( $row['p2'] ),
		'p3'   => intval( $row['p3'] ),

// not show blog site title
		'site_title'     => $site_title ,
		'site_title_s'   => $this->sanitize( $site_title ),
		'site_link'      => $site_link ,
		'site_link_s'    => $this->sanitize_url( $site_link ),

		'title'          => $title ,
		'title_s'        => $this->sanitize( $title ),
		'link'           => $link ,
		'link_s'         => $this->sanitize_url( $link ),
		'author_uri_s'   => $this->sanitize( $row['author_uri'] ),
		'entry_id_s'     => $this->sanitize( $row['entry_id'] ),
		'guid_s'         => $this->sanitize( $row['guid'] ),
		'category_s'     => $this->sanitize( $row['category'] ),
		'author_name_s'  => $this->sanitize( $row['author_name'] ),
		'author_email_s' => $this->sanitize( $row['author_email'] ),
		'type_cont_s'    => $this->sanitize( $row['type_cont'] ),
		'summary_disp'   => $this->sanitize( $summary ),
		'content_disp'   => $content,
		'fulltext'       => $row['content'],

		'published_unix' => $published_unix,
		'updated_unix'   => $updated_unix,
		'updated_long'   => formatTimestamp( $updated_unix, 'l' ),
		'updated_short'  => formatTimestamp( $updated_unix, 's' ),
		'updated_mysql'  => formatTimestamp( $updated_unix, 'mysql' ),

		'enclosure_url_s'     => $this->sanitize_url( $row['enclosure_url'] ),
		'enclosure_type_s'    => $this->sanitize( $row['enclosure_type'] ),
		'enclosure_length'    => intval( $row['enclosure_length'] ),
		'enclosure_length_kb' => intval( $row['enclosure_length']/1024 ),
		'enclosure_mode'      => $enclosure_mode,

		'icon' => $this->sanitize( $icon ) ,

		'gicon_id'  => $gicon_id ,
		'geo_lat'   => $row['geo_lat'] ,
		'geo_long'  => $row['geo_long'] ,

// without sanisize
		'media_content_url'      => $row['media_content_url'] ,
		'media_content_type'     => $row['media_content_type']  ,
		'media_content_medium'   => $row['media_content_medium']  ,
		'media_content_filesize' => $row['media_content_filesize'] ,
		'media_content_width'    => $row['media_content_width'] ,
		'media_content_height'   => $row['media_content_height'] ,
		'media_thumbnail_url'    => $row['media_thumbnail_url'] ,
		'media_thumbnail_width'  => $row['media_thumbnail_width'] ,
		'media_thumbnail_height' => $row['media_thumbnail_height'] ,

		'thumb_url'              => $thumb_url ,
		'thumb_url_s'            => $this->sanitize_url( $thumb_url ) ,
		'thumb_width'            => $thumb_width ,
		'thumb_height'           => $thumb_height ,
	);

	return $feed;
}

function build_future($value)
{
	$time = time() + 86400 * intval($value);	// days
	return $time;
}

function build_order( $value, $flag=false )
{
	$prefix = '';
	if ( $flag ) {
		$prefix = 'f.';
	}

	switch ( $value )
	{
		case 1:
			$order = $prefix.'published_unix DESC, '.$prefix.'fid DESC';
			break;

		case 0:
		default:
			$order = $prefix.'updated_unix DESC, '.$prefix.'fid DESC';
			break;
	}

	return $order;
}

function substitute_title($str)
{
	if ( strlen($str) > 0 ) {
		return $str;
	}
	return "---";
}

function build_date( $mode )
{
	$show_short  = false;
	$show_middle = false;
	$show_long   = false;

	switch ( $mode )
	{
		case 0:
			break;

		case 2:
			$show_middle = true;
			break;

		case 3:
			$show_long = true;
			break;

		case 1:
		default:
			$show_short = true;
			break;
	}

	return array( $show_short, $show_middle, $show_long );
}

function adjust_size( $width, $height )
{
	$max_width  = $this->_MAX_WIDTH ;
	$max_height = $this->_MAX_HEIGHT ;
	$flag_zero  = $this->_FLAG_ZERO ;

	if ( $flag_zero && (( $width == 0 )||( $height == 0 )) ) {
		return array( $max_width, 0 );
	}

	if ($width > $max_width)
    {
    	$mag    = $max_width / $width;
    	$width  = $max_width;
    	$height = $height * $mag;
    }

	if ($height > $max_height)
    {
    	$mag    = $max_height / $height;
    	$height = $max_height;
    	$width  = $width * $mag;
    }

    $width  = intval($width);
    $height = intval($height);

	return array($width, $height);
}

function sanitize( $str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}

function sanitize_url( $str )
{
	$str = $this->undo_htmlspecialchars( $str );
	$str = htmlspecialchars($str, ENT_QUOTES);
	return $str;
}

function undo_htmlspecialchars( $str )
{
	$arr = array(
		'&amp;'  =>  '&',
		'&lt;'   =>  '<',
		'&gt;'   =>  '>',
		'&quot;' =>  '"',
		'&#39;'  =>  "'",
		'&#039;' =>  "'",
		'&apos;' =>  "'",
	);
	$str = strtr( $str, $arr );
	return $str;
}

// --- class end ---
}

// === class end ===
}

?>