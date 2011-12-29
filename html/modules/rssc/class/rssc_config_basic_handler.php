<?php
// $Id: rssc_config_basic_handler.php,v 1.1 2011/12/29 14:37:15 ohwada Exp $

// 2007-10-10 K.OHWADA
// _load_config_once()

// 2006-09-20 K.OHWADA
// small change

// 2006-07-10 K.OHWADA
// this is new file
// unify with weblinks
// use happy_linux_basic_handler

//================================================================
// RSS Center Module
// 2006-07-10 K.OHWADA
//================================================================

// === class begin ===
if( !class_exists('rssc_config_basic_handler') ) 
{

//=========================================================
// class rssc_config_basic_handler
// this class handle MySQL table directly
// this class does not use another class
//=========================================================
class rssc_config_basic_handler extends happy_linux_basic_handler
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_config_basic_handler( $dirname )
{
	$this->happy_linux_basic_handler( $dirname );

	$this->set_table_name('config');
	$this->set_id_name('conf_id');

	$this->set_debug_db_sql(   RSSC_DEBUG_CONFIG_BASIC_SQL );
	$this->set_debug_db_error( RSSC_DEBUG_ERROR );

// load config
	$this->_load_config_once();

}

// --- class end ---
}

// === class end ===
}

?>