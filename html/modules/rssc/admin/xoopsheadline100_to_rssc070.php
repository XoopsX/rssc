<?php
// $Id: xoopsheadline100_to_rssc070.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-10-10 K.OHWADA
// rssc v0.70
// rssc_import_handler

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from xoopsheadline100_to_rssc010

//================================================================
// RSS Center Module
// import from xoopshedline 1.00 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================

// system files
include 'admin_header.php';

include_once RSSC_ROOT_PATH.'/api/refresh.php';
include_once RSSC_ROOT_PATH.'/class/rssc_import_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_xoopsheadline_handler.php';


//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
class admin_import_xoopsheadline extends rssc_import_handler
{
	var $_DIRNAME_XOOPSHEADLINE = 'xoopsheadline';
	var $_xoopsheadline_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_import_xoopsheadline()
{
	$this->rssc_import_handler( RSSC_DIRNAME );
	$this->set_mid_orig_by_dirname( $this->_DIRNAME_XOOPSHEADLINE );

	$this->_xoopsheadline_handler =& rssc_xoopsheadline_handler::getInstance( $this->_DIRNAME_XOOPSHEADLINE );

}

public static function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_import_xoopsheadline();
	}
	return $instance;
}

//=========================================================
// import from xoopsheadline
//=========================================================
function hl_first_step()
{
	$this->_hl_form_xoopsheadline();
}

function hl_import_xoopsheadline()
{
	echo "<h4>import link table</h4>\n";

	$offset = $this->get_post_offset();
	$next   = $this->calc_next();

	$total =  $this->_xoopsheadline_handler->get_count_all();
	$objs  =& $this->_xoopsheadline_handler->get_objects_for_import($this->_LIMIT, $offset);

	echo "There are <b>".$total."</b> xoopsheadline in XoopsHeadline<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	foreach ($objs as $obj)
	{
		$rssc_lid = $this->import_link_common( $obj );
	}

	if ( $total > $next ) {
		$this->_form_link($next);
	} else {
		$this->_print_finish();
	}

}

function _hl_form_xoopsheadline()
{
	$title  = 'import xoopsheadline';
	$op     = 'import_xoopsheadline';
	$submit = 'GO';

	$this->_print_form_next($title, $op, $submit);

}

// --- class end ---
}

//================================================================
// main
//================================================================

xoops_cp_header();

$import =& admin_import_xoopsheadline::getInstance();

$op = 'main';
if ( isset($_POST['op']) )  $op = $_POST['op'];

rssc_admin_print_bread( _AM_RSSC_UPDATE_MANAGE, 'update_manage.php', 'xoopshedline' );
echo "<h3>"._AM_RSSC_IMPORT_XOOPSHEADLINE."</h3>\n";
echo "Import DB xoopshedline 1.00 to rssc 0.70 <br /><br />\n";

if( !$import->exist_module() ) 
{
	xoops_error( $import->get_msg_not_installed() );
	xoops_cp_footer();
	exit();
}

switch ($op) 
{
case "import_xoopsheadline":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->hl_import_xoopsheadline();
	}
	break;

case 'main':
default:
	$import->hl_first_step();
	break;

}

xoops_cp_footer();
exit();

?>