<?php
// $Id: weblinks097_to_rssc070.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

// 2007-10-10 K.OHWADA
// rssc v0.70
// rssc_import_handler

// 2006-09-20 K.OHWADA
// use rssc_admin_print_bread()

// 2006-07-10 K.OHWADA
// use admin_import_base
// move from weblinks096_to_rssc010.php

//================================================================
// RSS Center Module
// import from weblinks 0.97 to rssc 0.30
// 2006-07-10 K.OHWADA
//================================================================

// system files
include 'admin_header.php';

include_once RSSC_ROOT_PATH.'/api/refresh.php';
include_once RSSC_ROOT_PATH.'/class/rssc_import_handler.php';
include_once RSSC_ROOT_PATH.'/class/rssc_weblinks_handler.php';

//=========================================================
// class admin_import_weblinks
//=========================================================
class admin_import_weblinks extends rssc_import_handler
{
	var $_DIRNAME_WEBLINKS = 'weblinks';

	var $_weblinks_handler;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_import_weblinks()
{
	$this->rssc_import_handler( RSSC_DIRNAME );
	$this->set_mid_orig_by_dirname( $this->_DIRNAME_WEBLINKS );

	$this->_rss_parser =& happy_linux_rss_parser::getInstance();

	$this->_weblinks_handler =& rssc_weblinks_handler::getInstance( $this->_DIRNAME_WEBLINKS );
	$this->_weblinks_handler->set_debug_db_error( true );
	$this->_weblinks_handler->load_config();
}

function &getInstance()
{
	static $instance;
	if (!isset($instance)) 
	{
		$instance = new admin_import_weblinks();
	}
	return $instance;
}

//=========================================================
// import from weblinks
//=========================================================
function first_step()
{

?>
<br />
There are 5 steps. <br />
1. import rss site <br />
2. import black list <br />
3. import white list <br />
4. import link table <br />
5. import feed table <br />
excute each <?php echo $this->_LIMIT; ?> records at a time <br />
<br />
<?php

	$this->_form_site();

}

function main_import_site()
{
	echo "<h4>STEP 1: import rss site</h4>\n";

	$offset = $this->get_post_offset();
	$next   = $this->calc_next();

	$site_list = $this->_weblinks_handler->get_config_list_by_name( 'rss_site' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> rss site in weblinks<br /><br />\n";

	$this->clear_num();

	foreach ($site_list as $site_url)
	{
		$this->import_site_weblinks( $site_url );
	}

	$this->_form_black();

}

function main_import_black()
{
	echo "<h4>STEP 2: import block list</h4>\n";

	$offset = $this->get_post_offset();
	$next   = $this->calc_next();

	$site_list = $this->_weblinks_handler->get_config_list_by_name( 'rss_black' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> black list in weblinks<br /><br />\n";

	$this->clear_num();

	foreach ($site_list as $site_url)
	{
		$this->import_black_weblinks( $site_url );
	}

	$this->_form_white();

}

function main_import_white()
{
	echo "<h4>STEP 3: import white list</h4>\n";

	$offset = $this->get_post_offset();
	$next   = $this->calc_next();

	$site_list = $this->_weblinks_handler->get_config_list_by_name( 'rss_white' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> white list in weblinks<br /><br />\n";

	$this->clear_num();

	foreach ($site_list as $site_url)
	{
		$this->import_white_weblinks( $site_url );
	}

	$this->_form_link();

}

function main_import_link()
{
	echo "<h4>STEP 4: import link table</h4>\n";

	$total  = $this->_weblinks_handler->get_link_count_rss_flag_prev_ver();
	$offset = $this->get_post_offset();
	$next   = $this->calc_next( $total );

	echo "There are <b>".$total."</b> rss links in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$objs =& $this->_weblinks_handler->get_link_objects_rss_flag_prev_ver($this->_LIMIT, $offset);

	foreach ($objs as $obj)
	{
		$rssc_lid = $this->import_link_weblinks( $obj );
	}

	if ( $total > $next ) {
		$this->_form_link($next);
	} else {
		$this->_form_feed();
	}

}


function main_import_feed()
{
	echo "<h4>STEP 5: import feed table</h4>\n";

	$total  = $this->_weblinks_handler->get_atomfeed_count();
	$offset = $this->get_post_offset();
	$next   = $this->calc_next( $total );

	echo "There are <b>".$total."</b> feeds in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$objs =& $this->_weblinks_handler->get_atomfeed_objects($this->_LIMIT, $offset);

	$this->_set_lid_list();

	foreach ($objs as $obj)
	{
		$rssc_lid = $this->import_feed_weblinks( $obj );
	}

	if ( $total > $next ){
		$this->_form_feed($next);
	} else {
		$this->_print_finish();
	}

}

//=========================================================
// private
//=========================================================
function _form_site()
{
	$title  = 'STEP 1 : import rss site';
	$op     = 'import_site';
	$submit = 'GO STEP 1';

	$this->_print_form_next($title, $op, $submit);

}

function _form_black()
{
	$title  = 'STEP 2 : import black list';
	$op     = 'import_black';
	$submit = 'GO STEP 2';

	$this->_print_form_next($title, $op, $submit);

}

function _form_white()
{
	$title  = 'STEP 3 : import white list';
	$op     = 'import_white';
	$submit = 'GO STEP 3';

	$this->_print_form_next($title, $op, $submit);

}

function _form_link($offset=0)
{
	$title  = 'STEP 4 : import link table';
	$op     = 'import_link';

	if ($offset)
	{
		$submit = "GO next $this->_LIMIT links";
	}
	else
	{
		$submit = 'GO STEP 4';
	}

	$this->_print_form_next($title, $op, $submit, $offset);

}

function _form_feed($offset=0)
{
	$title  = "STEP 5 : import feed table";
	$op     = 'import_feed';

	if ($offset)
	{
		$submit = "GO next $this->_LIMIT feeds";
	}
	else
	{
		$submit = 'GO STEP 5';
	}

	$this->_print_form_next($title, $op, $submit, $offset);

}

// --- class end ---
}

//=========================================================
// main
//=========================================================
xoops_cp_header();

$import =& admin_import_weblinks::getInstance();

$op = 'main';
if ( isset($_POST['op']) )  $op = $_POST['op'];

rssc_admin_print_bread( _AM_RSSC_UPDATE_MANAGE, 'update_manage.php', 'weblinks' );
echo "<h3>"._AM_RSSC_IMPORT_WEBLINKS."</h3>\n";
echo "Import DB weblinks 0.97 to rssc 0.70 <br /><br />\n";

if( !$import->exist_module() ) 
{
	xoops_error( $import->get_msg_not_installed() );
	xoops_cp_footer();
	exit();
}

switch ($op) 
{
case "import_site":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->main_import_site();
	}
	break;

case "import_black":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->main_import_black();
	}
	break;

case "import_white":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->main_import_white();
	}
	break;

case "import_link":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->main_import_link();
	}
	break;

case "import_feed":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->main_import_feed();
	}
	break;

case 'main':
default:
	$import->first_step();
	break;

}

xoops_cp_footer();
exit();

?>