<?php
// $Id: rssc_install.php,v 1.2 2011/12/29 18:47:54 ohwada Exp $

// 2011-12-29 K.OHWADA
// TYPE=MyISAM -> ENGINE=MyISAM

// 2009-02-20 K.OHWADA
// _update_feed_100()

// 2008-12-11 K.OHWADA
// preg_match_column_type_array()

// 2008-02-24 K.OHWADA
// change varchar to text: link

// 2008-01-20 K.OHWADA
// _update_link_080_1()

// 2007-11-26 K.OHWADA
// BLOB and TEXT columns cannot have DEFAULT values.

//=========================================================
// Rss Center Module
// 2007-11-11 K.OHWADA
//=========================================================

if( ! class_exists('rssc_install') ) 
{

//=========================================================
// class rssc_install
//=========================================================
class rssc_install extends happy_linux_module_install
{
	var $_DIRNAME;

	var $_link_table;
	var $_xml_table;
	var $_black_table;
	var $_white_table;
	var $_word_table;
	var $_feed_table;

	var $_DEBUG_TRACE = true ;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_install( $dirname )
{
	$this->_DIRNAME = $dirname;

	$this->happy_linux_module_install();
	$this->set_config_define_class( rssc_config_define::getInstance( $dirname ) );
	$this->set_config_table_name( $dirname.'_config' );

	$this->_link_table  = $this->prefix( $dirname.'_link' );
	$this->_xml_table   = $this->prefix( $dirname.'_xml' );
	$this->_black_table = $this->prefix( $dirname.'_black' );
	$this->_white_table = $this->prefix( $dirname.'_white' );
	$this->_word_table  = $this->prefix( $dirname.'_word' );
	$this->_feed_table  = $this->prefix( $dirname.'_feed' );

}

function &getInstance( $dirname )
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new rssc_install( $dirname );
	}
	return $instance;
}

//---------------------------------------------------------
// public
//---------------------------------------------------------
function check_install()
{
	if ( !$this->check_init_config() )
	{	return false;	}

	return true;
}

function install()
{
	$this->init_config();
	$this->set_msg( $this->get_init_config_msg() );

	return $this->return_flag_error();
}

function check_update()
{
	if ( !$this->exists_table( $this->_xml_table ) ) {
		$this->_set_error( 'NOT exist xml table' );
		return false;
	}

	if ( !$this->exists_table( $this->_word_table ) ) {
		$this->_set_error( 'NOT exist word table' );
		return false;
	}

	if ( !$this->_check_config_040() ) {
		$this->_set_error( 'NOT config 040' );
		return false;
	}

	if ( !$this->_check_link_100() ) {
		$this->_set_error( 'NOT link 100' );
		return false;
	}

	if ( !$this->_check_link_080_1() ) {
		$this->_set_error( 'NOT link 080_1' );
		return false;
	}

	if ( !$this->_check_link_080_2() ) {
		$this->_set_error( 'NOT link 080_2' );
		return false;
	}

	if ( !$this->_check_link_080_3() ) {
		$this->_set_error( 'NOT link 080_3' );
		return false;
	}

	if ( !$this->_check_link_070() ) {
		$this->_set_error( 'NOT link 070' );
		return false;
	}

	if ( !$this->_check_black_060() ) {
		$this->_set_error( 'NOT black 060' );
		return false;
	}

	if ( !$this->_check_black_070() ) {
		$this->_set_error( 'NOT black 070' );
		return false;
	}

	if ( !$this->_check_white_060() ) {
		$this->_set_error( 'NOT white 060' );
		return false;
	}

	if ( !$this->_check_white_070() ) {
		$this->_set_error( 'NOT white 070' );
		return false;
	}

	if ( !$this->_check_feed_100() ) {
		$this->_set_error( 'NOT feed 100' );
		return false;
	}

	if ( !$this->_check_feed_090() ) {
		$this->_set_error( 'NOT feed 090' );
		return false;
	}

	if ( !$this->_check_feed_060() ) {
		$this->_set_error( 'NOT feed 060' );
		return false;
	}

	if ( !$this->_check_feed_030() ) {
		$this->_set_error( 'NOT feed 030' );
		return false;
	}

	if ( !$this->check_update_config() ){
		$this->_set_error( 'NOT update config' );
		return false;
	}

	return true;
}

function update()
{
	if ( !$this->exists_table( $this->_xml_table ) )
	{
		$this->clear_error();
		$this->_create_xml_table();
		$this->set_msg( $this->build_create_msg( $this->_xml_table ) );

		$this->_copy_link_to_xml();
		$this->set_msg( $this->_build_msg_copy_link_to_xml() );
	}

	if ( !$this->exists_table( $this->_word_table ) )
	{
		$this->clear_error();
		$this->_create_word_table();
		$this->set_msg( $this->build_create_msg( $this->_word_table ) );
	}

	if ( !$this->_check_config_040() )
	{
		$this->clear_error();
		$this->_update_config_040();
		$this->truncate_table( $this->_config_table );
		$this->set_msg( $this->build_update_msg( $this->_config_table ) );
	}

	$this->check_and_update_table( 'link',  '070' );
	$this->check_and_update_table( 'link',  '080_1' );
	$this->check_and_update_table( 'link',  '080_2' );
	$this->check_and_update_table( 'link',  '080_3' );
	$this->check_and_update_table( 'link',  '100' );
	$this->check_and_update_table( 'black', '060' );
	$this->check_and_update_table( 'black', '070' );
	$this->check_and_update_table( 'white', '060' );
	$this->check_and_update_table( 'white', '070' );
	$this->check_and_update_table( 'feed',  '030' );
	$this->check_and_update_table( 'feed',  '060' );
	$this->check_and_update_table( 'feed',  '090' );
	$this->check_and_update_table( 'feed',  '100' );

	$this->update_config();
	$this->set_msg( $this->get_update_config_msg() );

	$this->clear_all_template();
	$this->set_msg( $this->build_tpl_msg() );

	return $this->return_flag_error();
}

//---------------------------------------------------------
// config table
//---------------------------------------------------------
function _check_config_040()
{
	return $this->exists_column( $this->_config_table, 'conf_valuetype' );
}

function _update_config_040()
{
$sql = "
  ALTER TABLE ". $this->_config_table ." ADD COLUMN (
  conf_valuetype varchar(255) NOT NULL default ''
)";

	return $this->query($sql);
}

//---------------------------------------------------------
// copy link to xml
//---------------------------------------------------------
function _copy_link_to_xml()
{
	$this->clear_error();

	foreach ( $this->_get_link_rows() as $link_row )
	{
		$lid   = $link_row['lid'];
		$ltype = $link_row['ltype'];
		$xml   = $link_row['xml'];

// copy if not exist
		if ( !$this->_get_xml_count( $lid ) )
		{
			$this->_insert_xml( $lid, $xml );

// ltype 0 -> 2
			if ( $ltype == 0 )
			{	$ltype = 2;	}
			$this->_update_link_for_xml( $lid, $ltype );
		}
	}

	return $this->return_errors();

}

function _build_msg_copy_link_to_xml()
{
	$link_table = $this->_sanitize( $this->_link_table );
	$xml_table  = $this->_sanitize( $this->_xml_table );
	$title = 'copy <b>'. $link_table .'</b> to <b>'. $xml_table .'</b>';

	if ( $this->return_errors() )
	{
		$msg = $title.' successfully ';
	}
	else
	{
		$msg  = $this->_highlight( 'ERROR: '.$title )."<br />\n";
		$msg .= $this->_get_errors();
	}

	return $msg;

}

//---------------------------------------------------------
// xml table
//---------------------------------------------------------
function _create_xml_table()
{
// remove ; in tail of sql

$sql = "
CREATE TABLE ".$this->_xml_table." (
  xid int(11) unsigned NOT NULL auto_increment,
  lid int(11) unsigned default '0',
  xml  mediumtext NOT NULL,
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY  (xid),
  KEY lid (lid)
) ENGINE=MyISAM
";

	return $this->query($sql);
}

function _insert_xml( &$row )
{
	return $this->query( $this->_build_insert_xml_sql( $row ) );
}

function _build_insert_xml_sql( $lid, $xml )
{
	$sql  = 'INSERT INTO '.$this->_xml_table.' (';
	$sql .= 'lid, ';
	$sql .= 'xml ';
	$sql .= ') VALUES (';
	$sql .= intval($lid).', ';
	$sql .= $this->quote($xml).' ';
	$sql .= ')';

	return $sql;
}

function _get_xml_count( $lid )
{
	$sql = 'SELECT count(*) FROM '. $this->_link_table .' WHERE lid='.intval( $lid );
	return $this->get_count_by_sql( $sql );
}

//---------------------------------------------------------
// word table
//---------------------------------------------------------
function _create_word_table()
{
$sql = "
CREATE TABLE ".$this->_word_table." (
  sid   int(11) unsigned NOT NULL auto_increment,
  word  varchar(255) default '',
  reg   tinyint(1) unsigned default '0',
  point int(11) unsigned default '0',
  count int(11) unsigned default '0',
  aux_int_1 int(5) default '0',
  aux_int_2 int(5) default '0',
  aux_text_1 varchar(255) default '',
  aux_text_2 varchar(255) default '',
  PRIMARY KEY  (sid)
) ENGINE=MyISAM
";

	return $this->query($sql);
}

//---------------------------------------------------------
// link table
//---------------------------------------------------------
function _check_link_100()
{
	return $this->exists_column( $this->_link_table, 'gicon_id' );
}

function _check_link_080_1()
{
	return $this->preg_match_column_type_array( 
		$this->_link_table, 'censor', array('text','blob') );
}

function _check_link_080_2()
{
	return $this->preg_match_column_type_array( 
		$this->_link_table, 'plugin', array('text','blob') );
}

function _check_link_080_3()
{
	return $this->exists_column( $this->_link_table, 'post_plugin' );
}

function _check_link_070()
{
	return $this->exists_column( $this->_link_table, 'enclosure' );
}

function _update_link_100()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  icon varchar(255) default '',
  gicon_id int(10) default'0'
)";

	return $this->query($sql);
}

function _update_link_080_1()
{
$sql = "
  ALTER TABLE ".$this->_link_table." MODIFY 
  censor text NOT NULL
";

	return $this->query($sql);
}

function _update_link_080_2()
{
$sql = "
  ALTER TABLE ".$this->_link_table." MODIFY 
  plugin text NOT NULL
";

	return $this->query($sql);
}

function _update_link_080_3()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  post_plugin text NOT NULL
)";

	return $this->query($sql);
}

function _update_link_070()
{
$sql = "
  ALTER TABLE ".$this->_link_table." ADD COLUMN (
  enclosure tinyint(2) default '1',
  censor    varchar(255) default '',
  plugin    varchar(255) default ''
)";

	return $this->query($sql);
}

function _update_link_for_xml( $lid, $ltype )
{
	$sql  = 'UPDATE '.$this->_link_table.' SET ';
	$sql .= 'ltype='. intval($ltype);
	$sql .= 'xml='. $this->quote('');
	$sql .= ' WHERE lid='.intval($lid);

	return $this->query($sql);
}

function &_get_link_rows()
{
	$sql = 'SELECT * FROM '.$this->_link_table.' ORDER BY lid';
	return $this->get_rows_by_sql($sql);
}

//---------------------------------------------------------
// feed table
//---------------------------------------------------------
function _check_feed_100()
{
	return $this->exists_column( $this->_feed_table, 'geo_lat' );
}

function _check_feed_090()
{
	return $this->preg_match_column_type_array( 
		$this->_feed_table, 'link', array('text','blob') );
}

function _check_feed_060()
{
	return $this->exists_column( $this->_feed_table, 'act' );
}

function _check_feed_030()
{
	return $this->exists_column( $this->_feed_table, 'enclosure_url' );
}

function _update_feed_100()
{
$sql = "
  ALTER TABLE ".$this->_feed_table." ADD COLUMN (
  geo_lat  double(10,8) NOT NULL default '0',
  geo_long double(11,8) NOT NULL default '0',
  media_content_url    varchar(255) default '',
  media_content_type   varchar(255) default '',
  media_content_medium varchar(255) default '',
  media_content_filesize int(10) default '0',
  media_content_width    int(10) default '0',
  media_content_height   int(10) default '0',
  media_thumbnail_url    varchar(255) default '',
  media_thumbnail_width  int(10) default '0',
  media_thumbnail_height int(10) default '0'
)";

	return $this->query($sql);
}

function _update_feed_090()
{
	$ret = $this->_update_feed_090_1();
	if ( !$ret )
	{	return false;	}

	$ret = $this->_update_feed_090_2();
	if ( !$ret )
	{	return false;	}

	$ret = $this->_update_feed_090_3();
	if ( !$ret )
	{	return false;	}

	return true;
}

function _update_feed_090_1()
{
	$sql = "ALTER TABLE ".$this->_feed_table." DROP INDEX link";
	return $this->query($sql);
}

function _update_feed_090_2()
{

$sql = "
  ALTER TABLE ".$this->_feed_table." MODIFY
  link text default ''
";

	return $this->query($sql);
}

function _update_feed_090_3()
{
	$sql = "ALTER TABLE ".$this->_feed_table." ADD INDEX link (link(10))";
	return $this->query($sql);
}

function _update_feed_060()
{
$sql = "
  ALTER TABLE ".$this->_feed_table." ADD COLUMN (
  act   tinyint(1) default '1'
)";

	return $this->query($sql);
}

function _update_feed_030()
{
$sql = "
  ALTER TABLE ".$this->_feed_table." ADD COLUMN (
  enclosure_url  varchar(255) default '',
  enclosure_type varchar(255) default '',
  enclosure_length int(5) default '0'
)";

	return $this->query($sql);
}


//---------------------------------------------------------
// black table
//---------------------------------------------------------
function _check_black_070()
{
	return $this->exists_column( $this->_black_table, 'cache' );
}

function _check_black_060()
{
	return $this->exists_column( $this->_black_table, 'act' );
}

function _update_black_070()
{
$sql = "
  ALTER TABLE ".$this->_black_table." ADD COLUMN (
  cache int(11) default '0',
  ctime int(11) default '0'
)";

	return $this->query($sql);
}

function _update_black_060()
{
$sql = "
  ALTER TABLE ".$this->_black_table." ADD COLUMN (
  act   tinyint(1) default '1',
  reg   tinyint(1) default '0',
  count int(11) default '0'
)";

	return $this->query($sql);
}


//---------------------------------------------------------
// white table
//---------------------------------------------------------
function _check_white_070()
{
	return $this->exists_column( $this->_white_table, 'cache' );
}

function _check_white_060()
{
	return $this->exists_column( $this->_white_table, 'act' );
}

function _update_white_070()
{
$sql = "
  ALTER TABLE ".$this->_white_table." ADD COLUMN (
  cache int(11) default '0',
  ctime int(11) default '0'
)";

	return $this->query($sql);
}

function _update_white_060()
{
$sql = "
  ALTER TABLE ".$this->_white_table." ADD COLUMN (
  act   tinyint(1) default '1',
  reg   tinyint(1) default '0',
  count int(11) default '0'
)";

	return $this->query($sql);
}

//---------------------------------------------------------
// template
//---------------------------------------------------------
function clear_all_template()
{
	$dir_tpl = XOOPS_ROOT_PATH .'/modules/'. $this->_DIRNAME .'/templates';

	$this->clear_error();

	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/xml' );
	$this->clear_compiled_tpl_by_dir( $dir_tpl .'/parts' );

	return $this->return_errors();
}

// --- class end ---
}

// === class end ===
}

?>