<?php
// $Id: admin_list_black_white.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-10-10 K.OHWADA
// divid from admin_list_black & admin_list_white

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class admin_list_black_white extends happy_linux_page_frame
{
// class instance
	var $_feed_handler;

// black & white
	var $_TITLE_BW    = null;
	var $_TILTE_ID_BW = null;

	var $_CACHE_TIME = 3600;	// 1 hour

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_list_black_white()
{
	$this->happy_linux_page_frame();
	$this->set_max_sortid(4);

// class instance
	$this->_feed_handler =& rssc_get_handler('feed', RSSC_DIRNAME);
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_list_black_whitee();
	}
	return $instance;
}

//---------------------------------------------------------
// black & white
//---------------------------------------------------------
function &_get_table_header()
{
	$arr = array(
		$this->_TILTE_ID_BW,
		_AM_RSSC_SHOW_FEED,
		_RSSC_SITE_LINK,
		_RSSC_SITE_TITLE,
		_RSSC_FREQ_COUNT,
	);

	return $arr;
}

function &_get_items($limit=0, $start=0)
{
	switch ($this->_sortid)
	{
		case 1:
			$objs =& $this->_handler->get_objects_desc($limit, $start);
			break;

		case 2:
			$objs =& $this->_handler->get_objects_count_desc($limit, $start);
			break;

		case 3:
			$objs =& $this->_handler->get_objects_count_asc($limit, $start);
			break;

		case 0:
		default:
			$objs =& $this->_handler->get_objects_asc($limit, $start);
			break;
	}

	return $objs;
}

function _print_top()
{
	switch ($this->_sortid)
	{
		case 1:
			$title = _HAPPY_LINUX_ID_DESC;
			break;

		case 2:
			$title = _AM_RSSC_COUNT_DESC;
			break;

		case 3:
			$title = _AM_RSSC_COUNT_ASC;
			break;

		case 0:
		default:
			$title = _HAPPY_LINUX_ID_ASC;
			break;
	}

	echo "<h4>". $this->_TITLE_BW ."</h4>\n";
	printf(_RSSC_THEREARE, $this->_get_total_all() );
	echo "<br /><br />\n";

	echo "<table width='80%' border='0' cellspacing='1' class='outer'>";
	echo "<tr class='odd'><td>";
	echo "<li><a href='?sortid=0'>"._HAPPY_LINUX_ID_ASC."</a></li>\n";
	echo "<li><a href='?sortid=1'>"._HAPPY_LINUX_ID_DESC."</a></li>\n";
	echo "<li><a href='?sortid=2'>"._AM_RSSC_COUNT_DESC."</a></li>\n";
	echo "<li><a href='?sortid=3'>"._AM_RSSC_COUNT_ASC."</a></li>\n";
	echo"</td></tr></table>\n";

	echo "<h4>".$title."</h4>\n";
}

function _get_name_feed( &$obj )
{
	$count = $this->_get_count( $obj );
	if ($count) {
		$name = "FEED ($count)";
	} else {
		$name = "FEED";
	}
	return $name;
}

function _get_count( &$obj )
{
	if ( time() > ($obj->get('ctime') + $this->_CACHE_TIME) ) 
	{
		$count = $this->_feed_handler->get_count_by_link( $obj->get('url') );
		if ( $count )
		{
			$this->_update_cache( $obj, $count );
		}
	}
	else 
	{
		$count = $obj->get('cache');
	}
	return $count;
}

function _update_cache( &$obj, $cache )
{
	$obj->setVar( 'cache', $cache );
	$obj->setVar( 'ctime', time() );
	return $this->_handler->update( $obj, true );
}

// --- class end ---
}

?>