<?php
// $Id: rssc_link_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2008-01-30 K.OHWADA
// get_cache_post_plugin_by_lid()

// 2007-10-10 K.OHWADA
// enclosure

// 2007-06-01 K.OHWADA
// divid to xml_basic_handler
// get_link_by_lid() etc

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// use happy_linux_basic happy_linux_basic_handler

// 2006-06-04 K.OHWADA
// this is new file
// move from link_handler

//=========================================================
// Rss Center Module
// 2006-06-04 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_link_basic_handler') ) 
{

//=========================================================
// class rssc_link_basic
//=========================================================
class rssc_link_basic extends happy_linux_basic
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_link_basic()
{
	$this->happy_linux_basic();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_link_basic();
	}
	return $instance;
}

//---------------------------------------------------------
// show
//---------------------------------------------------------
function &get_show()
{
	$time      = intval( $this->get('updated_unix') );
	$title     = $this->get('title');
	$url       = $this->get('url');
	$rdf_url   = $this->get('rdf_url');
	$rss_url   = $this->get('rss_url');
	$atom_url  = $this->get('atom_url');
	$encoding  = $this->get('encoding');
	$url_xml   = $this->get_rssurl_by_mode();
	$icon      = $this->_get_rss_icon_by_mode( $this->get('mode') );

	$arr = array(
		'lid'            => intval( $this->get('lid') ),
		'uid'            => intval( $this->get('uid') ),
		'mid'            => intval( $this->get('mid') ),
		'p1'             => intval( $this->get('p1') ),
		'p2'             => intval( $this->get('p2') ),
		'p3'             => intval( $this->get('p3') ),
		'ltype'          => intval( $this->get('ltype') ),
		'refresh'        => intval( $this->get('refresh') ),
		'headline'       => intval( $this->get('headline') ),
		'mode'           => intval( $this->get('mode') ),
		'updated_unix'   => $time,
		'title'          => $title,
		'url'            => $url,
		'rdf_url'        => $rdf_url,
		'rss_url'        => $rss_url,
		'atom_url'       => $atom_url,
		'encoding'       => $encoding,
		'url_xml'        => $url_xml,
		'icon'           => $icon,
		'title_s'        => $this->sanitize_text( $title ),
		'url_s'          => $this->sanitize_url(  $url ),
		'rdf_url_s'      => $this->sanitize_url(  $rdf_url ),
		'rss_url_s'      => $this->sanitize_url(  $rss_url ),
		'atom_url_s'     => $this->sanitize_url(  $atom_url ),
		'encoding_s'     => $this->sanitize_text( $encoding ),
		'url_xml_s'      => $this->sanitize_url(  $url_xml ),
		'icon_s'         => $this->sanitize_text( $icon ),
		'updated_long'   => formatTimestamp( $time, 'l' ),
		'updated_middle' => formatTimestamp( $time, 'm' ),
		'updated_short'  => formatTimestamp( $time, 's' ),
		'updated_mysql'  => formatTimestamp( $time, 'mysql' ),
	);

	return $arr;
}

//---------------------------------------------------------
// element
//---------------------------------------------------------
// refresh_handler
function get_rssurl_by_mode()
{
	$mode     = $this->get('mode');
	$rdf_url  = $this->get('rdf_url');
	$rss_url  = $this->get('rss_url');
	$atom_url = $this->get('atom_url');
	$ret = $this->_get_rssurl_by_mode_url( $mode, $rdf_url, $rss_url, $atom_url );
	return $ret;
}

// admin/parse_rss.php
function get_rssurl_select_by_mode( $mode )
{
	$rdf_url  = $this->get('rdf_url');
	$rss_url  = $this->get('rss_url');
	$atom_url = $this->get('atom_url');
	$ret = $this->_get_rssurl_by_mode_url( $mode, $rdf_url, $rss_url, $atom_url );
	return $ret;
}

function _get_rssurl_by_mode_url( $mode, $rdf_url, $rss_url, $atom_url )
{
	$val = false;
	switch ($mode)
	{
		case RSSC_C_MODE_RDF:
			$val = $rdf_url;
			break;

		case RSSC_C_MODE_RSS:
			$val = $rss_url;
			break;

		case RSSC_C_MODE_ATOM:
			$val = $atom_url;
			break;
	}
	return $val;
}

function _get_rss_icon_by_mode( $mode )
{
	switch ( $mode )
	{
		case RSSC_C_MODE_RDF:
			return 'rdf.png';
			break;

		case RSSC_C_MODE_RSS:
			return 'rss.png';
			break;

		case RSSC_C_MODE_ATOM:
			return 'atom.png';
			break;
	}
	return false;
}

function refresh_expired()
{
	if ( time() > ( $this->get('refresh') + $this->get('updated_unix') ) )
	{
		return true;
	}

	return false;
}

function &get_channel()
{
	$ret =& $this->getVarArray('channel');
	return $ret;
}

// --- class end ---
}

//=========================================================
// class rssc_link_basic_handler
// this class is used by command line
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
class rssc_link_basic_handler extends happy_linux_basic_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_link_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );

	$this->set_table_name('link');
	$this->set_id_name('lid');
	$this->set_class_name('rssc_link_basic');

	$this->set_debug_db_sql(   RSSC_DEBUG_LINK_BASIC_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );

}

//---------------------------------------------------------
// update
//---------------------------------------------------------
function update_xml_url($lid, $mode, $rdf_url, $rss_url, $atom_url)
{
	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'mode='. intval($mode).', ';
	$sql .= 'rdf_url='.  $this->quote($rdf_url).', ';
	$sql .= 'rss_url='.  $this->quote($rss_url).', ';
	$sql .= 'atom_url='. $this->quote($atom_url).' ';
	$sql .= 'WHERE lid='.intval($lid);

	$ret = $this->query($sql);
	return $ret;
}

function update_encoding($lid, $encoding)
{
	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'encoding='. $this->quote($encoding).' ';
	$sql .= 'WHERE lid='.intval($lid);

	$ret = $this->query($sql);
	return $ret;
}

function update_channel($lid, $channel, $updated_unix='', $flag_channel=true )
{
	if ( $flag_channel )
	{
		$channel = serialize($channel);
	}
	if ( empty($updated_unix) )
	{
		$updated_unix = $time();
	}

	$sql  = 'UPDATE '.$this->_table.' SET ';
	$sql .= 'channel='. $this->quote($channel).', ';
	$sql .= 'updated_unix='. intval($updated_unix).' ';;
	$sql .= 'WHERE lid='.intval($lid);

	$ret = $this->query($sql);
	return $ret;
}

//---------------------------------------------------------
// get
//---------------------------------------------------------
function exists_by_lid($lid)
{
	$row =& $this->get_cache_row($lid);
	if ( is_array($row) )
	{
		return true;
	}
	return false;
}

function &get_link_by_lid($lid)
{
	$arr = false;
	$link_obj =& $this->get_cache_object_by_id($lid);
	if ( is_object($link_obj) )
	{
		$arr =& $link_obj->get_show();
	}
	return $arr;
}

function &get_headline_lids($limit=0, $start=0)
{
	$sql  = 'SELECT lid FROM '.$this->_table.' WHERE ';
	$sql .= ' headline>0';
	$sql .= ' ORDER BY headline ASC';
	$arr  =& $this->get_first_row_by_sql($sql, $limit, $start);
	return $arr;
}

function &get_headline_rows($limit=0, $start=0)
{
	$sql  = 'SELECT * FROM '.$this->_table.' WHERE ';
	$sql .= ' headline>0';
	$sql .= ' ORDER BY headline ASC';
	$rows =& $this->get_rows_by_sql($sql, $limit, $start);
	return $rows;
}

function &get_headlines($limit=0, $start=0)
{
	$links = false;
	$rows =& $this->get_headline_rows($limit, $start);
	if ( is_array($rows) && count($rows) )
	{
		$objs =& $this->get_objects_from_rows( $rows );
		foreach ($objs as $obj)
		{
			$links[] =& $obj->get_show();
		}
	}
	return $links;
}

// refresh all
function &get_active_id_array($limit=0, $offset=0)
{
// normal or search site
	$sql =  'SELECT lid FROM '.$this->_table;
	$sql .= ' WHERE ltype<>0';
	$sql .= ' ORDER BY lid ASC';
	$arr =& $this->get_first_row_by_sql($sql, $limit, $offset);
	return $arr;
}

function get_cache_post_plugin_by_lid($lid)
{
	$row =& $this->get_cache_row( $lid );
	if ( !is_array($row) )
	{
		$this->_set_errors( "rssc_link_handler: no link record: lid = ".$lid );
		return false;
	}
	else
	{
		return $row['post_plugin'];
	}
	return false;
}

function get_cache_ltype_by_lid($lid)
{
	$row =& $this->get_cache_row( $lid );
	if ( !is_array($row) )
	{
		$this->_set_errors( "rssc_link_handler: no link record: lid = ".$lid );
		return false;
	}
	else
	{
		return $row['ltype'];
	}
	return false;
}

function get_cache_enclosure_by_lid($lid)
{
	$row =& $this->get_cache_row( $lid );
	if ( !is_array($row) )
	{
		$this->_set_errors( "rssc_link_handler: no link record: lid = ".$lid );
		return false;
	}
	else
	{
		return $row['enclosure'];
	}
	return false;
}

function &get_channel_by_lid($lid)
{
	$ret = false;
	$obj =& $this->get_cache_object_by_id($lid);
	if ( !is_object($obj) )
	{
		$this->_set_errors( "rssc_xml_handler: no xml record: lid = $lid" );
		return $ret;
	}
	$ret =& $obj->get_channel();
	return $ret;
}

// --- class end ---
}

// === class end ===
}

?>