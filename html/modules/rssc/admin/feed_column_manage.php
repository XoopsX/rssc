<?php
// $Id: feed_column_manage.php,v 1.1 2012/03/31 04:46:34 ohwada Exp $

//=========================================================
// RSS Center Module
// 2012-03-01 K.OHWADA
//=========================================================

include 'admin_header.php';

include_once XOOPS_ROOT_PATH.'/class/template.php';

include_once RSSC_ROOT_PATH.'/api/view.php';
include_once RSSC_ROOT_PATH.'/api/refresh.php';

//---------------------------------------------------------
// entry_id
// http://savemlak.jp/savemlak/index.php?title=%E7%89%B9%E5%88%A5:%E6%9C%80%E8%BF%91%E3%81%AE%E6%9B%B4%E6%96%B0&feed=atom
//
// guid
// http://cureeastjapan.jimdo.com/rss/blog
//
// content
// http://www.earthday-tokyo.org/2011/news/atom.xml
//---------------------------------------------------------

//=========================================================
// class admin_feed_column_manage
//=========================================================
class admin_feed_column_manage extends happy_linux_error
{
// handler
	var $_feed_basic_handler;
	var $_post;
	var $_form ;

	var $_THIS_URL ;

	var $_COLUMN_ARRAY = array(
		'entry_id' => 'varchar', 
		'guid'     => 'varchar', 
		'media_content_url'   => 'varchar', 
		'media_thumbnail_url' => 'varchar', 
		'content' => 'text',
	);

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_feed_column_manage()
{
	$this->happy_linux_error();

	$this->_feed_basic_handler =& rssc_get_handler('feed_basic', RSSC_DIRNAME);
	$this->_post_class =& happy_linux_post::getInstance();
	$this->_form_class =& admin_form_feed_column::getInstance();

	$this->_THIS_URL = RSSC_URL.'/admin/feed_column_manage.php';
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new admin_feed_column_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// main
//---------------------------------------------------------
function get_op()
{
	return $this->_post_class->get_post('op');
}

function main()
{
	$this->form();
}

function update()
{
	if( ! $this->_form_class->check_token() ) {
		$msg = $this->_form->get_token_error();
		redirect_header( $this->_THIS_URL, 5, $msg );
		exit();
	}

	$feed_column_ids = $this->_post_class->get_post('feed_column_id');
	$fields  = $this->_post_class->get_post('field');
	$updates = $this->_post_class->get_post('update');

	if ( !is_array($feed_column_ids) || !count($feed_column_ids) ) {
		redirect_header( $this->_THIS_URL, 5, 'No Data' );
		exit();
	}

	$arr = array();

	foreach ( $feed_column_ids as $id ) {
		$id = intval($id);
		if ( !isset( $fields[ $id ] ) ) {
			continue;
		}
		if ( !isset( $updates[ $id ] ) ) {
			continue;
		}

		$arr[] = array(
			'field' => $fields[  $id ] ,
			'type'  => $updates[ $id ] ,
		);
	}

	$ret = $this->_feed_basic_handler->update_column_type( $arr );
	if ( $ret ) {
		$msg  = _HAPPY_LINUX_UPDATED ;
		$time = 3;
	} else {
		$msg  = $this->_feed_basic_handler->getErrros(1);
		$time = 5;
	}

	redirect_header( $this->_THIS_URL, $time, $msg );
}

function form()
{
	echo "<h3>". _AM_RSSC_FEED_COLUMN_MANAGE ."</h3>\n";
	$rows = $this->_feed_basic_handler->get_columns();
	$keys = array_keys( $this->_COLUMN_ARRAY );

	$arr = array();
	foreach ( $rows as $row ) {
		$field = $row['Field'];
		$type  = $row['Type'];

		if ( !in_array($field, $keys) ) {
			continue;
		}

		$type_orig = $this->_COLUMN_ARRAY[ $field ];

		$update = '';
		if ( ($type_orig == 'varchar' ) && preg_match( '/^varchar/i', $type ) ) {
			$update = 'text';
		} elseif ( ($type_orig == 'text' ) && preg_match( '/^text/i', $type ) ) {
			$update = 'mediumtext';
		}

		$arr[] = array(
			'field'  => $field,
			'type'   => $type,
			'update' => $update,
		);
	}

	$this->_form_class->print_form( $arr );
}

// --- class end ---
}

//=========================================================
// class admin_form_feed_column
//=========================================================
class admin_form_feed_column extends happy_linux_form
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_form_feed_column()
{
	$this->happy_linux_form();
}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new admin_form_feed_column();
	}
	return $instance;
}

function print_form( $fields )
{
// form start
	echo $this->build_form_begin('feed_column');
	echo $this->build_token();
	echo $this->build_html_input_hidden('op', 'update');

	echo $this->build_form_table_begin();

	$all = $this->build_form_js_checkall();

	echo '<tr>';
	echo '<th>'.$all.'</th>'."\n";
	echo '<th>field</th>'."\n";;
	echo '<th>type</th>'."\n";;
	echo '<th>new type</th>'."\n";
	echo '</tr>'."\n";

	foreach ( $fields as $k => $v ) {
		$field  = $v['field'];
		$type   = $v['type'];
		$update = $v['update'];

		$js           = '';
		$field_hidden = '';
		$update_name  = '';

		if ( $update ) {
			$js = $this->build_form_js_checkbox( $k );
			$field_name    = 'field['.$k.']';
			$field_hidden  = $this->build_html_input_hidden($field_name, $field);
			$update_name   = 'update['.$k.']';
			$update_hidden = $this->build_html_input_hidden($update_name, $update);
		} else {
			$js     = '-';
			$update = '---';
		}

		echo '<tr>';
		echo '<td>'.$js.'</td>'."\n";
		echo '<td>'.$field.$field_hidden.'</td>'."\n";
		echo '<td>'.$type.'</td>'."\n";
		echo '<td>'.$update.$update_hidden.'</td>'."\n";
		echo '</tr>'."\n";

	}

	$submit = $this->build_html_input_submit('submit', _HAPPY_LINUX_UPDATE);

	echo '<tr>';
	echo $this->build_html_td_tag_begin('', '', 1, '', 'foot');
	echo '</td>';
	echo $this->build_html_td_tag_begin('', '', 3, '', 'foot');
	echo $submit.'</td>';
	echo '</tr>'."\n";

	echo $this->build_form_table_end();
	echo $this->build_form_end();
}

// --- class end ---
}

//=========================================================
// main
//=========================================================
$manage =& admin_feed_column_manage::getInstance();

$op = $manage->get_op();
switch ($op)
{
	case 'update':
		$manage->update();
		exit();
		break;

	case 'form':
	default:
			break;
}

xoops_cp_header();

rssc_admin_print_header();
rssc_admin_print_menu();

$manage->main();

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// === main end ===

?>