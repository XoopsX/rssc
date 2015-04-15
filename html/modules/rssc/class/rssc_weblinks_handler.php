<?php
// $Id: rssc_weblinks_handler.php,v 1.1 2011/12/29 14:37:17 ohwada Exp $

// 2007-10-10 K.OHWADA
// move from weblinks097_to_rssc030.php

//=========================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//=========================================================

//=========================================================
// class rssc_weblinks_handler
//=========================================================
class rssc_weblinks_handler extends happy_linux_basic_handler
{
	var $_table_config;
	var $_table_link;
	var $_table_atomfeed;

	var $_strings;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_weblinks_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );
	$this->set_table_name( 'link' );
	$this->set_id_name( 'lid' );

	$this->_table_config   = $this->db_prefix( $dirname.'_config' );
	$this->_table_link     = $this->db_prefix( $dirname.'_link' );
	$this->_table_atomfeed = $this->db_prefix( $dirname.'_atomfeed' );

	$this->_strings =& happy_linux_strings::getInstance();
}

public static function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_weblinks_handler( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function load_config()
{
	$sql = "SELECT * FROM ".$this->_table_config;
	$this->_conf_cached =& $this->get_row_by_sql($sql);
}

function get_config_list_by_name( $name )
{
	$value = $this->get_conf_by_name($name);
	$list = $this->_strings->convert_string_to_array( $value, "\n" );
	return $list;
}

function get_link_count_rss_flag_prev_ver()
{
	$sql   = "SELECT count(*) FROM ".$this->_table_link;
	$sql  .= " WHERE ( rss_flag=1 OR rss_flag=2 )";
	$count = $this->get_count_by_sql($sql);
	return $count;
}

function &get_link_objects_rss_flag_prev_ver( $limit=0, $offset=0 )
{
	$sql  = "SELECT * FROM ".$this->_table_link;
	$sql .= " WHERE ( rss_flag=1 OR rss_flag=2 ) ORDER BY lid";
	$rows =& $this->get_rows_by_sql($sql, $limit, $offset);
	$objs =& $this->get_objects_from_rows( $rows );
	return $objs;
}

function get_atomfeed_count()
{
	$sql   = "SELECT count(*) FROM ".$this->_table_atomfeed;
	$count = $this->get_count_by_sql($sql);
	return $count;
}

function &get_atomfeed_objects( $limit=0, $offset=0 )
{
	$sql  = "SELECT * FROM ".$this->_table_atomfeed;
	$sql .= " ORDER BY lid";
	$rows =& $this->get_rows_by_sql($sql, $limit, $offset);
	$objs =& $this->get_objects_from_rows( $rows );
	return $objs;
}

// --- class end ---
}

?>