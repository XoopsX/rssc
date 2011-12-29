<?php
// $Id: search.inc.php,v 1.1 2011/12/29 14:37:05 ohwada Exp $

// 2006-09-01 K.OHWADA
// show context for suin's search
// highlight_keyword
// BUG: rssc/single.php was not found

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/include/search.php';

$rssc_dirname = basename( dirname( dirname( __FILE__ ) ) );

// --- eval begin ---
eval( '

function '.$rssc_dirname.'_search( $queryarray , $andor , $limit , $offset , $uid )
{
	return rssc_search_base( "'.$rssc_dirname.'" , $queryarray , $andor , $limit , $offset , $uid ) ;
}

' );
// --- eval end ---


// --- rssc_search_base begin ---
if( !function_exists( 'rssc_search_base' ) ) 
{

function rssc_search_base($dirname, $queryarray, $andor, $limit, $offset, $uid)
{
	global $xoopsDB;

	$table_config = $xoopsDB->prefix( $dirname.'_config' );
	$table_feed   = $xoopsDB->prefix( $dirname.'_feed' );

// config data
	$conf_data = array();

	$sql1 = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res1 = $xoopsDB->query($sql1, 0, 0);
	if ( !$res1 )
	{
		return $block;
	}

	while ($row1 = $xoopsDB->fetchArray($res1)) 
	{
		$conf_data[ $row1['conf_name'] ] = $row1['conf_value'];
	}

	$future_days = $conf_data['basic_future_days'];
	$future = time() + 86400 * $future_days;	// days

// search
	$hightlight_key = '';
	$where = '';

	if ( $uid != 0 ) 
	{	$where .= "uid=$uid ";	}

	$count = count($queryarray);
	if ( is_array($queryarray) && ( $count > 0 ) )
	{
		$keywords = implode('+', $queryarray);
		$hightlight_key = '&amp;keywords='.urlencode($keywords);

		if ($where)  $where .= "AND ";
		$where .= "( search LIKE '%$queryarray[0]%' ";

		for ($i=1; $i<$count; $i++)
		{
			$where .= "$andor ";
			$where  .= "search LIKE '%$queryarray[$i]%' ";
		}
		$where .= ") ";
	}

	$sql2  = 'SELECT * FROM '.$table_feed;
	$sql2 .= ' WHERE '.$where;
	$sql2 .= ' AND updated_unix <'.  $future;
	$sql2 .= ' AND published_unix <'.$future;
	$sql2 .= ' ORDER BY updated_unix DESC';

	$res2 = $xoopsDB->query($sql2, $limit, $offset);

	$ret = array();
	$i = 0;

	while( $row2 = $xoopsDB->fetchArray($res2) )
	{
// BUG: rssc/single.php was not found	
		$ret[$i]['link']  = 'single_feed.php?fid='.$row2['fid'].$hightlight_key;

		$ret[$i]['time']  = $row2['updated_unix'];
		$ret[$i]['uid']   = 0;
		$ret[$i]['image'] = "images/home.gif";

	// fully uri
		$ret[$i]['full_link'] = $row2['link'];

	// title
		$title = $row2['title'];
		$title = preg_replace("/>/", '> ', $title);
		$title = strip_tags( $title );
		$ret[$i]['title'] = $title;

	// show context
		$context = $row2['content'];
		$context = preg_replace("/>/", '> ', $context);
		$context = strip_tags( $context );
		$ret[$i]['context'] = happy_linux_build_search_context($context, $queryarray);

		$i++;
	}

	return $ret;
}

// --- rssc_search_base end ---
}

?>