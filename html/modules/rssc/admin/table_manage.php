<?php
// $Id: table_manage.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-11-24 K.OHWADA
// happy_linux_table_manage()

// 2007-11-01 K.OHWADA
// xoops block table check
// rssc_admin_print_footer()

// 2006-09-20 K.OHWADA
// this is new file

//================================================================
// RSS Center Module
// 2006-09-10 K.OHWADA
//================================================================

include 'admin_header.php';
include 'admin_header_config.php';

include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/table_manage.php';
include_once XOOPS_ROOT_PATH.'/modules/happy_linux/class/xoops_block_checker.php';

//================================================================
// class admin_table_manage
//================================================================
class admin_table_manage extends happy_linux_table_manage
{
	var $_link_handler;

	var $_TITLE_LINK_CHECK = 'check link table';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_table_manage()
{
	$this->happy_linux_table_manage( RSSC_DIRNAME );

	$this->set_config_handler('config', RSSC_DIRNAME, 'rssc');
	$this->set_config_define( rssc_config_define::getInstance() );
	$this->set_install_class( rssc_install::getInstance( RSSC_DIRNAME ) );
	$this->set_xoops_block_checker();

	$this->_link_handler  =& rssc_get_handler('link',  RSSC_DIRNAME );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_table_manage();
	}
	return $instance;
}

//---------------------------------------------------------
// check
//---------------------------------------------------------
function menu()
{
	rssc_admin_print_header();
	rssc_admin_print_menu();

	$this->print_title();

// rssc table
	$this->print_table_check( 'config' );
	$this->check_config_table();
	$this->_check_table_for_rssc( 'link' );
	$this->_check_table_for_rssc( 'xml' );
	$this->_check_table_for_rssc( 'feed' );
	$this->_check_table_for_rssc( 'black' );
	$this->_check_table_for_rssc( 'white' );
	$this->_check_table_for_rssc( 'word' );

// xoops block table
	$this->check_xoops_block_table();
	$this->print_form_remove_xoops_block_table();

// check link table
	echo "<h4>". $this->_TITLE_LINK_CHECK ."</h4>\n";
	echo "check to overlap same RDF/RSS/ATOM url<br />\n";
	echo "There are <b>". $this->_link_handler->getCount() ."</b> links <br />\n";

	$this->_print_form_link_start();
}

function _check_table_for_rssc( $table )
{
	$this->print_table_check( $table );
	$this->check_table_scheme_by_name( $table, RSSC_DIRNAME, 'rssc' );
}

//---------------------------------------------------------
// action
//---------------------------------------------------------
function check_link()
{
	$total  = $this->_link_handler->getCount();

	$this->print_bread( $this->_TITLE_LINK_CHECK );
	echo "<h4>". $this->_TITLE_LINK_CHECK ."</h4>\n";
	echo "There are <b>". $total ."</b> links <br />\n";

	$max    = $this->get_max_record();
	$offset = $this->get_post_offset();
	$start  = $offset + 1;
	$end    = $this->calc_end( $start, $total );

	echo "check ". $start ." - ".$end." th record <br /><br />\n";

	$count_more = 0;

	$objs =& $this->_link_handler->get_objects_asc( $max, $offset );
	foreach ($objs as $obj)
	{
		$this->_link_handler->set_cache_by_obj( $obj );
		$lid_1    = $obj->get('lid');
		$title_1  = $obj->get('title');
		$rdf_url  = $obj->get('rdf_url');
		$rss_url  = $obj->get('rss_url');
		$atom_url = $obj->get('atom_url');

		$lid_arr =& $this->_link_handler->get_list_by_rssurl( $rdf_url, $rss_url, $atom_url, $lid_1 );
		if ( is_array($lid_arr) && count($lid_arr) )
		{
			echo $this->_build_link_manage($lid_1, $title_1);
			echo " : <b>same links</b> <br />\n";
			$count_more ++;

			foreach ($lid_arr as $lid_2)
			{
				$obj_2 =& $this->_link_handler->getCache( $lid_2 );
				if ( is_object($obj_2) )
				{
					$title_2  = $obj_2->get('title');
					echo " --- ";
					echo $this->_build_link_manage($lid_2, $title_2);
					echo "<br />\n";
				}
			}
		}
	}

	echo "<br />\n";

	if ( $count_more )
	{
		echo "There are ";
		echo $this->build_span_red_bold( $count_more );
		echo " links which have same links <br />\n";
	}
	else
	{
		$this->print_blue( "check OK" );
	}

	if ( $total > $end )
	{
		$this->_print_form_link_next( $end, $total );
	}
	else
	{
		$this->print_finish();
	}

}

function _build_link_manage($lid, $title)
{
	$url    = 'link_manage.php?op=mod_form&amp;lid='.$lid;
	$lid_s  = sprintf("%03d", $lid);
	$text   = '<a href="'. $url .'" target="_blank">'. $lid_s .'</a>';
	$text  .= " : ".$this->sanitize_text( $title );
	return $text;
}

//---------------------------------------------------------
// print
//---------------------------------------------------------
function _print_form_link_start()
{
	$this->_print_form_link_common( _HAPPY_LINUX_EXECUTE );
}

function _print_form_link_next( $end_prev, $total )
{
	$start  = $end_prev + 1;
	$end    = $this->calc_end( $start, $total );
	$step   = $end - $start + 1;
	$submit = "GO next ". $step . " links";
	$desc   = "check ". $start ." - ". $end ." th record";
	$next   = $end - 1;

	$this->_print_form_link_common( $submit, $desc, $next );
}

function _print_form_link_common( $submit, $desc=null, $offset=0 )
{
	echo "<br />\n";
	echo $this->_form->build_lib_box_limit_offset(
		$this->_TITLE_LINK_CHECK, $desc, 0, $offset, 'check_link', $submit );
}

// --- class end ---
}


//================================================================
// main
//================================================================

$manage =& admin_table_manage::getInstance();

$op = $manage->get_post_op();

switch ($op) 
{
case 'renew_config':
	$manage->renew_config();
	break;

case 'remove_block':
	xoops_cp_header();
	$manage->remove_block();
	break;

case 'check_link':
	xoops_cp_header();
	$manage->check_link();
	break;

case 'menu':
default:
	xoops_cp_header();
	$manage->menu();
	break;

}

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---

?>