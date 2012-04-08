<?php
// $Id: rssc_icon.php.\040ORIGINAL\0401.10.php,v 1.1 2012/04/08 23:42:20 ohwada Exp $

//=========================================================
// Rss Center Module
// 2009-02-20 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_icon') ) 
{

//=========================================================
// class rssc_icon
//=========================================================
class rssc_icon
{
	var $_db ;

	var $_ICON_COLS    = 5 ;
	var $_ICON_DEFAULT = 'default.gif' ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_icon()
{
	$this->_db =& Database::getInstance();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new rssc_icon();
	}
	return $instance;
}

// --------------------------------------------------------
// build icon list
// --------------------------------------------------------
function build_template_icon_list( $dirname )
{
	$MODULE_DIR = XOOPS_ROOT_PATH.'/modules/'.$dirname;
	$template   = $MODULE_DIR.'/templates/parts/rssc_icon_list.html';

// build template
	$tpl = new XoopsTpl();
	$tpl->assign( 'xoops_url',  XOOPS_URL );
	$tpl->assign( 'dirname',    $dirname );
	$tpl->assign( 'icon_cols',  $this->_ICON_COLS );
	$tpl->assign( 'icon_list',  $this->build_icon_list( $dirname ) );
	$ret = $tpl->fetch( $template );
	return $ret;
}

function build_icon_list( $dirname )
{
	$conf = $this->get_config_row( $dirname );
	if ( !is_array($conf) ) {
		return false;
	}

	$rows = $this->get_link_rows( $dirname ) ;
	if ( !is_array($rows) ) {
		return false;
	}

	$arr  = array();
	foreach ($rows as $row)
	{
		if ( empty($row['icon']) ) continue;

		$tmp['title'] = $this->sanitize( $row['title'] );
		$tmp['lid']   = $this->sanitize( $row['lid'] );
		$tmp['icon']  = $this->sanitize( $row['icon'] );
		$arr[] = $tmp ;
	}

	$tmp['title'] = $this->sanitize( _BL_RSSC_LINK_ETC );
	$tmp['icon']  = $this->sanitize( $this->_ICON_DEFAULT );
	$arr[] = $tmp ;

	return $arr;
}

function get_config_row( $dirname )
{
	$arr = array();

	$table_config = $this->_db->prefix( $dirname.'_config' );
	$sql = 'SELECT * FROM '.$table_config.' ORDER BY conf_id ASC';

	$res = $this->_db->query($sql, 0, 0);
	if ( !$res ) {
		return false;
	}

	while ($row = $this->_db->fetchArray($res)) {
		$arr[ $row['conf_name'] ] = $row['conf_value'];
	}
	return $arr;
}

function get_link_rows( $dirname )
{
	$rows = array();

	$table_link = $this->_db->prefix( $dirname.'_link' );
	$sql = 'SELECT * FROM '.$table_link.' WHERE ltype<>0 ORDER BY lid ASC';

	$res = $this->_db->query( $sql );
	if ( !$res ) {
		return false;
	}

	while ($row = $this->_db->fetchArray($res)) {
		$rows[] = $row ;
	}
	return $rows;
}

function sanitize($str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}

// --- class end ---
}

// === class end ===
}

?>