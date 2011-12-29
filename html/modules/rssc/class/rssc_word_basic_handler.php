<?php
// $Id: rssc_word_basic_handler.php,v 1.1 2011/12/29 14:37:14 ohwada Exp $

//=========================================================
// Rss Center Module
// 2007-06-01 K.OHWADA
//=========================================================

// === class begin ===
if( !class_exists('rssc_word_basic_handler') ) 
{

//=========================================================
// class word handler
// this class is used by command line
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
class rssc_word_basic_handler extends happy_linux_basic_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_word_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );

	$this->set_table_name('word');
	$this->set_id_name('sid');

	$this->set_debug_db_sql(   RSSC_DEBUG_WORD_BASIC_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );
}

//---------------------------------------------------------
// insert
//---------------------------------------------------------
function insert_word( $word )
{
	$sql  = 'INSERT INTO '.$this->_table.' ( ';
	$sql .= 'word';
	$sql .= ' ) VALUES ( ';
	$sql .= $this->quote($word);
	$sql .= ' )';
	$ret = $this->query($sql);
	return $ret;
}

//---------------------------------------------------------
// update
//---------------------------------------------------------
function countup($sid)
{
	$sql = 'UPDATE '.$this->_table.' SET count = count+1 WHERE sid='.intval($sid);
	$ret = $this->query($sql);
	return $ret;
}

//---------------------------------------------------------
// select
//---------------------------------------------------------
function &get_sid_array_older($limit=0, $offset=0)
{
// point=0
	$sql  = 'SELECT sid FROM '.$this->_table.' ';
	$sql .= 'WHERE point=0 ';
	$sql .= 'ORDER BY count ASC, sid ASC';
	$arr =& $this->get_first_row_by_sql($sql, $limit, $offset);
	return $arr;
}

function &get_rows_act($limit=0, $offset=0)
{
// word is filled
	$sql  = "SELECT * FROM ".$this->_table;
	$sql .= " WHERE word<>'' ";
	$sql .= " ORDER BY sid ASC";
	$rows =& $this->get_rows_by_sql($sql, $limit, $offset);
	return $rows;
}

function exists_word($word)
{
	$sql  = 'SELECT count(*) FROM '.$this->_table.' ';
	$sql .= 'WHERE word='.$this->quote($word);
	$ret  = $this->get_count_by_sql($sql);
	return $ret;
}

//---------------------------------------------------------
// add
//---------------------------------------------------------
function add_word_array( &$arr )
{
	foreach ($arr as $w)
	{
// insert new record, if not exist
		if ( !$this->exists_word($w) )
		{
			$this->insert_word($w);
		}
	}
}

//---------------------------------------------------------
// clear
//---------------------------------------------------------
function clear_over_num($num)
{
	if ($num <= 0)
	{
		return 0;	// no action
	}

	$total = $this->get_count_all();
	$limit = $total - $num;
	if ($limit <= 0)
	{
		return 0;	// no action
	}

	$sid_arr = $this->get_sid_array_older($limit);

// exec
	foreach( $sid_arr as $sid )
	{
		$this->delete_by_id($sid);
	}

	return $limit;
}

// --- class end ---
}

// === class end ===
}

?>