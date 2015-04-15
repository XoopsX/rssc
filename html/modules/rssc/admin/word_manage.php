<?php
// $Id: word_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-01 K.OHWADA
// BUG: dont work del_all
// main_del_all()
// set_flag_execute_time()

//=========================================================
// RSS Center Module
// 2007-06-01 K.OHWADA
//=========================================================

include 'admin_header.php';
include_once RSSC_ROOT_PATH.'/admin/admin_manage_base_class.php';

//=========================================================
// class word manage
//=========================================================
class admin_manage_word extends admin_manage_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_manage_word()
{
	$this->admin_manage_base();

	$this->set_handler( 'word', RSSC_DIRNAME, 'rssc' );
	$this->set_id_name( 'sid' );
	$this->set_form_class( 'admin_form_word' );
	$this->set_script(   'word_manage.php' );
	$this->set_redirect( 'word_list.php', 'word_list.php?sortid=1' );
	$this->set_title( _AM_RSSC_ADD_WORD, _AM_RSSC_MOD_WORD, _AM_RSSC_DEL_WORD );
	$this->set_list_id_name( 'word_search_id' );
	$this->set_flag_execute_time( true );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_manage_word();
	}
	return $instance;
}

//---------------------------------------------------------
// main_add_form()
//---------------------------------------------------------
function main_add_form()
{
	$this->_main_add_form();
}

//---------------------------------------------------------
// main_add_table()
//---------------------------------------------------------
function main_add_table()
{
	$this->_main_add_table( true );
}

function _check_add_table()
{
	$ret = $this->_check_mod_table();
	if ( !$ret )
	{	return false;	}

	$word =  $this->_post->get_post_text('word');
	$objs =& $this->_handler->get_objects_by_word($word);
	if ( is_array($objs) && count($objs) )
	{
		$script = 'word_manage.php?op=mod_form&amp;sid=';
		$msg    = $this->_handler->build_error_list($objs, $script);
		$err    = "<h4>"._AM_RSSC_WORD_ALREADY ."</h4>\n". $msg;
		$this->_set_error_extra( $err );
		return false;
	}

	return true;
}

//---------------------------------------------------------
// main_mod_form()
//---------------------------------------------------------
function main_mod_form()
{
	$this->_main_mod_form();
}

//---------------------------------------------------------
// main_mod_table()
//---------------------------------------------------------
function main_mod_table()
{
	$this->_main_mod_table( true );
}

function _check_mod_table()
{
	$this->_clear_errors();
	$this->_check_fill_by_post( 'word', _RSSC_WORD_WORD );
	return $this->returnExistError();
}

//---------------------------------------------------------
// main_del_table()
//---------------------------------------------------------
function main_del_table()
{
	$this->_main_del_table( true );
}

//---------------------------------------------------------
// modify point
//---------------------------------------------------------
function main_mod_all()
{
	$del     = $this->_post->get_post('del_all');
	$mod     = $this->_post->get_post('mod_all');
	$request = $this->_post->get_post('request_uri');
	$url     = 'word_list.php';

	if ( $request )
	{
		$this->set_redirect_mod_all( $request );
		$this->set_redirect_del_all( $request );
	}

	if ( $mod )
	{
		$this->_main_mod_all( true );
	}
	elseif ( $del )
	{
		$this->_main_del_all( true );
	}
	else
	{
		redirect_header( $url, 3, 'invalid submit name' );
	}
}

function _exec_mod_all()
{
	$word_arr  = $this->_post->get_post('word');
	$point_arr = $this->_post->get_post('point');

	foreach ($point_arr as $k => $v)
	{
		$sid   = intval($k);
		$point = intval($v);
		$word  = $word_arr[$sid];

		$obj =& $this->_handler->get($sid);
		if ( !is_object($obj) )
		{	continue;	}

// skip if same value
		if (( $point == $obj->get('point') )&&
			( $word  == $obj->get('word') ))
		{	continue;	}

		$obj->setVar('point', $point);
		$obj->setVar('word',  $word);

		$ret = $this->_handler->update($obj);
		if (!$ret)
		{
			$this->_set_error( $this->_handler->getErrors() );
		}
	}

	return $this->returnExistError();
}

//---------------------------------------------------------
// delete all
//---------------------------------------------------------
function main_del_all()
{
	$this->_main_del_all( true );
}

// --- class end ---
}

//=========================================================
// class admin_form_word
//=========================================================
class admin_form_word extends happy_linux_form
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_word()
{
	$this->happy_linux_form();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_form_word();
	}
	return $instance;
}

//---------------------------------------------------------
// show word
//---------------------------------------------------------
function _show(&$obj, $extra=null, $mode=0)
{
	switch ($mode) 
	{
		case HAPPY_LINUX_MODE_MOD:
		case HAPPY_LINUX_MODE_MOD_PREVIEW:
			$mode       = HAPPY_LINUX_MODE_MOD;
			$form_title = _AM_RSSC_MOD_WORD;
			$op         = 'mod_table';
			$button_val = _HAPPY_LINUX_MODIFY;
			break;

		case HAPPY_LINUX_MODE_ADD:
		case HAPPY_LINUX_MODE_ADD_PREVIEW:
		default:
			$form_title = _AM_RSSC_ADD_WORD;
			$op         = 'add_table';
			$button_val = _ADD;
			break;
	}

	$this->set_obj($obj);

// form start
	echo $this->build_form_begin();
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', $op);

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_html_input_hidden('sid', $obj->get('sid') );
	}

	echo $this->build_form_table_begin();
	echo $this->build_form_table_title($form_title);

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		echo $this->build_form_table_line(_RSSC_WORD_ID, $obj->get('sid') );
	}

	echo $this->build_obj_table_radio_yesno(_RSSC_REG_EXP, 'reg');
	echo $this->build_obj_table_text(_RSSC_WORD_WORD, 'word');
	echo $this->build_obj_table_text(_RSSC_WORD_POINT, 'point');
	echo $this->build_obj_table_text(_RSSC_FREQ_COUNT, 'count');

	echo $this->build_obj_table_textarea(_AM_RSSC_BLACK_MEMO, 'memo');

	$ele_submit = $this->build_html_input_submit('submit', $button_val);
	echo $this->build_form_table_line('', $ele_submit, 'foot', 'foot');

	if ( $mode == HAPPY_LINUX_MODE_MOD )
	{
		$ele_del    = $this->build_html_input_submit('del_table', _DELETE);
		$ele_cancel = $this->build_html_input_button_cancel('cancel', _CANCEL);
		echo $this->build_form_table_line('', $ele_del.'  '.$ele_cancel, 'foot', 'foot');
	}

	echo $this->build_form_table_end();
	echo $this->build_form_end();
// --- form end ---

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_manage_word::getInstance();

$op = $manage->get_op();

switch ($op)
{
	case 'add_table':
		$manage->main_add_table();
		break;

	case 'mod_form':
		$manage->main_mod_form();
		break;

	case 'mod_table':
		$manage->main_mod_table();
		break;

	case 'del_table':
		$manage->main_del_table();
		break;

	case 'mod_all':
		$manage->main_mod_all();
		break;

	case 'del_all':
		$manage->main_del_all();
		break;

	case 'add_form':
	default:
		$manage->main_add_form();
		break;
}

xoops_cp_footer();

exit();
// --- end of main ---

?>