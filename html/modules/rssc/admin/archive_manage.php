<?php
// $Id: archive_manage.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-11-01 K.OHWADA
// set_flag_execute_time()
// _UPDATE => _HAPPY_LINUX_EXECUTE

// 2007-06-01 K.OHWADA
// api/refresh.php
// learn_black()

// 2006-09-18 K.OHWADA
// use XoopsGTicket
// use build_lib_box_limit_offset()

// 2006-07-10 K.OHWADA
// move class admin_manage_archive from admin_form_class.php
// use happy_linux_form happy_linux_post
// change make_xxx to build_xxx

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// add check_token()

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once RSSC_ROOT_PATH.'/api/refresh.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/bin_file.php';
include_once RSSC_ROOT_PATH.'/class/rssc_refresh_all_handler.php';

//=========================================================
// class archive manage
//=========================================================
class admin_manage_archive extends happy_linux_manage
{
	var $_feed_handler;
	var $_black_handler;
	var $_refresh_handler;

	var $_post;

	var $_conf_feed_limit = 1000;
	var $_conf_word_limit = 1000;

	var $_limit;
	var $_offset;
	var $_num;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_archive()
{
	$this->happy_linux_manage( RSSC_DIRNAME );

	$this->set_handler( 'link_basic', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'lid' );
	$this->set_form_class( 'admin_form_archive' );
	$this->set_script('archive_manage.php' );
	$this->set_flag_execute_time( true );

	$this->_feed_handler    =& rssc_get_handler('feed_basic',   RSSC_DIRNAME);
	$this->_black_handler   =& rssc_get_handler('black_basic',  RSSC_DIRNAME);
	$this->_refresh_handler =& rssc_get_handler('refresh_all',  RSSC_DIRNAME);
	$conf_handler           =& rssc_get_handler('config_basic', RSSC_DIRNAME);

	$this->_post =& happy_linux_post::getInstance();

	$conf_data  =& $conf_handler->get_conf();
	$this->_conf_feed_limit =  $conf_data['basic_feed_limit'];
	$this->_conf_word_limit =  $conf_data['word_limit'];
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_archive();
	}
	return $instance;
}

//---------------------------------------------------------
// POST
//---------------------------------------------------------
function get_post_op()
{
	return $this->_post->get_post_get('op');
}

function get_post_limit()
{
	$this->_limit  = $this->_post->get_post_int('limit');	
	if ($this->_limit  < 0)  $this->_limit  = 0;
	return $this->_limit;
}

function get_post_offset()
{
	$this->_offset  = $this->_post->get_post_int('offset');	
	if ($this->_offset < 0)  $this->_offset = 0;
	return $this->_offset;
}

function get_post_num()
{
	$this->_num    = $this->_post->get_post_int('num', $this->_conf_feed_limit);
	return $this->_num;
}

//---------------------------------------------------------
// main_form()
//---------------------------------------------------------
function main_form()
{
	$total_link  = $this->_handler->get_count_all();
	$total_feed  = $this->_feed_handler->get_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ARCHIVE_MANAGE, 'main_form');
	rssc_admin_print_header();
	rssc_admin_print_menu();
	echo "<h3>"._AM_RSSC_ARCHIVE_MANAGE."</h3>\n";
	printf(_AM_RSSC_THERE_ARE_LINKS, $total_link);
	echo "<br />\n";
	printf(_AM_RSSC_THERE_ARE_FEEDS, $total_feed);
	echo "<br /><br />\n";

	$this->_print_form();
	$this->_print_cp_footer();
}

function _print_form()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();
	$num    = $this->get_post_num();

	echo "<a name='refresh'></a>";
	echo "<h4>"._AM_RSSC_REFRESH."</h4>\n";
	$this->_form->show_refresh($limit, $offset);

	echo "<a name='learn'></a>";
	echo "<h4>"._AM_RSSC_LEAN_BLACK."</h4>\n";
	Echo _AM_RSSC_LEAN_BLACK_DESC."<br /><br />\n";
	$this->_form->show_learn($limit, $offset);

	echo "<a name='clear'></a>";
	echo "<h4>"._AM_RSSC_FEED_CLEAR."</h4>\n";
	$this->_form->show_clear_old( $num );

}

//---------------------------------------------------------
// refresh_archive()
//---------------------------------------------------------
function refresh_archive()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$total_link  = $this->_handler->get_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_REFRESH);

	if ( !$this->_check_token() )
	{
		$this->_print_preview();
		exit();
	}

	$this->_refresh_handler->set_feed_limit($this->_conf_feed_limit);
	$this->_refresh_handler->set_word_limit($this->_conf_word_limit);
	$this->_refresh_handler->set_flag_chmod( true );

	$ret = $this->_refresh_handler->refresh($limit, $offset);
	if (!$ret)
	{
		echo $this->_feed_handler->getErrorCode();
	
		$this->_set_error_title( "Refresh Error" );
		$this->_set_errors( $this->_refresh_handler->getErrors() );
		$this->_print_error(1);
	}

	$next  = $offset + $limit;
	if (($limit > 0) && ($next < $total_link))
	{
		echo "<br />\n";
		$this->_form->show_refresh_next($limit, $next);
	}
	else
	{
		echo "<h4>"._RSSC_REFRESH_LINK_FINISHED."</h4>\n";
	}

	$this->_print_cp_footer();

}

function _print_preview()
{
	$this->_print_token_error(1);
	$this->_print_form();
	$this->_print_cp_footer();
}

//---------------------------------------------------------
// learn_black()
//---------------------------------------------------------
function learn_black()
{
	$limit  = $this->get_post_limit();
	$offset = $this->get_post_offset();

	$total_link  = $this->_black_handler->get_count_all();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_LEAN_BLACK);

	if ( !$this->_check_token() )
	{
		$this->_print_preview();
		exit();
	}

	$this->_refresh_handler->set_feed_limit($this->_conf_feed_limit);
	$this->_refresh_handler->set_word_limit($this->_conf_word_limit);
	$this->_refresh_handler->set_flag_chmod( true );

	$ret = $this->_refresh_handler->learn_black($limit, $offset);
	if (!$ret)
	{
		echo $this->_feed_handler->getErrorCode();
	
		$this->_set_error_title( "Learning Error" );
		$this->_set_errors( $this->_refresh_handler->getErrors() );
		$this->_print_error(1);
	}

	$next  = $offset + $limit;
	if (($limit > 0) && ($next < $total_link))
	{
		echo "<br />\n";
		$this->_form->show_learn_next($limit, $next);
	}
	else
	{
		echo "<h4>"._RSSC_REFRESH_LINK_FINISHED."</h4>\n";
	}

	$this->_print_cp_footer();

}

//---------------------------------------------------------
// clear_old()
//---------------------------------------------------------
function clear_old()
{
	$num = $this->get_post_num();

	$this->_print_cp_header();
	$this->_print_bread_op( _AM_RSSC_ARCHIVE_MANAGE, 'main_form', _AM_RSSC_FEED_CLEAR);
	$this->_print_title(    _AM_RSSC_FEED_CLEAR );

	if ( !$this->_check_token() )
	{
		$this->_print_preview();
		exit();
	}

	$del = $this->_feed_handler->clear_over_num( $num );
	if ($del)
	{
		echo "<h4>". _AM_RSSC_NUM_FEED_CLEARED ."</h4>\n";
		echo $del ." ". _AM_RSSC_NUM_FEEDS."<br />\n";
	}
	elseif ( !$this->_feed_handler->returnExistError() )
	{
		$this->_set_error_title( "DB Error" );
		$this->_set_errors( $this->_feed_handler->getErrors() );
		$this->_print_error(1);
	}
	else
	{
		echo $this->_form->build_html_blue( _HAPPY_LINUX_NO_ACTION );
	}

	$this->_print_cp_footer();
}


// --- class end ---
}

//=========================================================
// class admin_form_archive
//=========================================================
class admin_form_archive extends happy_linux_form_lib
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_archive()
{
	$this->happy_linux_form_lib();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_archive();
	}
	return $instance;
}

//---------------------------------------------------------
// show feed refresh
//---------------------------------------------------------
function show_refresh($limit=0, $offset=0)
{

// form start
	echo $this->build_form_begin('refresh');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'refresh');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title(_AM_RSSC_REFRESH);
	$ele_limit = $this->build_html_input_text('limit',  $limit);
	echo $this->build_form_table_line(_AM_RSSC_LINK_LIMIT, $ele_limit);
	$ele_offset = $this->build_html_input_text('offset',  $offset);
	echo $this->build_form_table_line(_AM_RSSC_LINK_OFFSET, $ele_offset);
	$ele_submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function show_refresh_next($limit=0, $offset=0)
{

// form start
	$desc   = '';
	$action = '';
	$submit = sprintf(_AM_RSSC_REFRESH_NEXT, $limit);

	$text = $this->build_lib_box_limit_offset(_AM_RSSC_REFRESH, $desc, $limit, $offset, 'refresh', $submit, $action);
	echo $text;
}

//---------------------------------------------------------
// show learn black
//---------------------------------------------------------
function show_learn($limit=0, $offset=0)
{

// form start
	echo $this->build_form_begin('learn');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'learn');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title( _AM_RSSC_LEAN_BLACK );
	$ele_limit = $this->build_html_input_text('limit',  $limit);
	echo $this->build_form_table_line(_AM_RSSC_LINK_LIMIT, $ele_limit);
	$ele_offset = $this->build_html_input_text('offset',  $offset);
	echo $this->build_form_table_line(_AM_RSSC_LINK_OFFSET, $ele_offset);
	$ele_submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_EXECUTE);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

function show_learn_next($limit=0, $offset=0)
{

// form start
	$desc   = '';
	$action = '';
	$submit = sprintf(_AM_RSSC_REFRESH_NEXT, $limit);

	$text = $this->build_lib_box_limit_offset( _AM_RSSC_LEAN_BLACK, $desc, $limit, $offset, 'learn', $submit, $action);
	echo $text;
}

//---------------------------------------------------------
// show feed clear
//---------------------------------------------------------
function show_clear_old($num=0)
{

// form start
	echo $this->build_form_begin('clear_old');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'clear_old');
	echo $this->build_form_table_begin();
	echo $this->build_form_table_title(_AM_RSSC_FEED_CLEAR_OLD);
	$ele_num = $this->build_html_input_text('num', $num);
	echo $this->build_form_table_line(_AM_RSSC_FEED_CLEAR_NUM, $ele_num);
	$ele_submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_CLEAR);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');
	echo $this->build_form_table_end();
	echo $this->build_form_end();

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_archive::getInstance();
$op     = $manage->get_post_op();

switch($op)
{
	case 'refresh':
		$manage->refresh_archive();
		break;

	case 'learn':
		$manage->learn_black();
		break;

	case 'clear_old':
		$manage->clear_old();
		break;

	default:
		$manage->main_form();
		break;
}

xoops_cp_footer();
exit();
// --- end of main ---

?>