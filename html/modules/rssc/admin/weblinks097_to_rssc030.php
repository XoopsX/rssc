<?php
// $Id: weblinks097_to_rssc030.php,v 1.1 2011/12/29 14:37:11 ohwada Exp $

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

// system files
include_once XOOPS_ROOT_PATH.'/class/snoopy.php';

// module files
include_once RSSC_ROOT_PATH.'/admin/admin_import_base_class.php';
include_once RSSC_ROOT_PATH.'/class/magpie/rssc_magpie_parse.php';
include_once RSSC_ROOT_PATH.'/class/magpie/rssc_magpie_cache.php';
include_once RSSC_ROOT_PATH.'/class/rssc_xml_object.php';
include_once RSSC_ROOT_PATH.'/class/rssc_xml_utility.php';
include_once RSSC_ROOT_PATH.'/class/rssc_parse_handler.php';

//=========================================================
// class admin_import_weblinks
//=========================================================
class admin_import_weblinks extends admin_import_base
{
	var $_DIRNAME_WEBLINKS = 'weblinks';

	var $_parse_handler;

	var $_table_weblinks_link;
	var $_table_weblinks_feed;
	var $_table_weblinks_config;

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function admin_import_weblinks()
{
	$this->admin_import_base();
	$this->set_dirname_orig( $this->_DIRNAME_WEBLINKS );

	$this->set_debug_db_sql(   0 );
	$this->set_debug_db_error( 1 );

	$this->_parse_handler =& rssc_parse_handler::getInstance();

	$this->_table_weblinks_link   = $this->db_prefix( $this->_DIRNAME_WEBLINKS.'_link' );
	$this->_table_weblinks_feed   = $this->db_prefix( $this->_DIRNAME_WEBLINKS.'_atomfeed' );
	$this->_table_weblinks_config = $this->db_prefix( $this->_DIRNAME_WEBLINKS.'_config' );

	$this->get_mid();
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

function import_site()
{
	echo "<h4>STEP 1: import rss site</h4>\n";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$next = $offset + $this->_LIMIT;

// weblinks list
	$site_list = $this->_get_weblinks_list( 'rss_site' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> rss site in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		echo $i.": ".htmlspecialchars($site_url);
		$i ++;

		if ( $this->_exist_url($site_url) )
		{
			echo " <b>skip</b> <br />\n";
			continue;
		}

		echo " <br />\n";

		$title = '';
		$link  = '';

		$parse_obj = $this->_parse_handler->parse_by_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
			$link  = $parse_obj->get_channel_by_key('link');
		}

		if ( empty($title) )
		{
			$title = 'RSS site '.$i;
		}

		$url      = $link;
		$rss_url  = $site_url;

		$link_obj =& $this->_link_handler->create();

		$link_obj->set('uid',      1 );	// admin
		$link_obj->set('mid',      $this->_mid );
		$link_obj->set('ltype',    RSSC_C_LINK_LTYPE_SERACH );
		$link_obj->set('mode',     RSSC_C_MODE_RSS );
		$link_obj->set('refresh',  3600 );	// 1 hour
		$link_obj->setVar('title',    $title,    true );
		$link_obj->setVar('url',      $url,      true );
		$link_obj->setVar('rss_url',  $rss_url,  true );

		$this->_link_handler->insert($link_obj);
		unset($link_obj);
	}

	$this->_form_black();

}

function import_black()
{
// === black table ===
// --- rssc ---
//  bid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  memo text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 2: import block list</h4>\n";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$next = $offset + $this->_LIMIT;

// weblinks list
	$site_list = $this->_get_weblinks_list( 'rss_black' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> black list in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		$title = '';

		$parse_obj =& $this->_parse_handler->discover_and_parse_by_html_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
		}

		if ( empty($title) )
		{
			$title = 'Black '.$i;
		}

		$url = $site_url;

		echo $i.": ".htmlspecialchars($url)." <br />\n";

		$black_obj =& $this->_black_handler->create();

		$black_obj->set('uid',      1 );	// admin
		$black_obj->set('mid',      $this->_mid );
		$black_obj->setVar('title',    $title,    true );
		$black_obj->setVar('url',      $url,      true );

		$this->_black_handler->insert($black_obj);
		unset($black_obj);

		$i ++;
	}

	$this->_form_white();

}

function import_white()
{
// === white table ===
// --- rssc ---
//  wid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  memo text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 3: import white list</h4>\n";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$next = $offset + $this->_LIMIT;

// weblinks list
	$site_list = $this->_get_weblinks_list( 'rss_white' );
	$total = count($site_list);

	echo "There are <b>".$total."</b> white list in weblinks<br /><br />\n";

	$i = 0;

	foreach ($site_list as $site_url)
	{
		$title = '';

		$parse_obj =& $this->_parse_handler->discover_and_parse_by_html_url($site_url);
		if ( is_object($parse_obj) )
		{
			$title = $parse_obj->get_channel_by_key('title');
		}

		if ( empty($title) )
		{
			$title = 'White '.$i;
		}

		$url = $site_url;

		echo $i.": ".htmlspecialchars($url)." <br />\n";

		$white_obj =& $this->_white_handler->create();

		$white_obj->set('uid',      1 );	// admin
		$white_obj->set('mid',      $this->_mid );
		$white_obj->setVar('title',    $title,    true );
		$white_obj->setVar('url',      $url,      true );

		$this->_white_handler->insert($white_obj);
		unset($white_obj);

		$i ++;
	}

	$this->_form_link();

}

function import_link()
{
// === link table ===

// --- weblinks ---
//  lid int(11)
//  cids  varchar(100) : use catlink
//  title varchar(100)
//  url varchar(255)
//  banner varchar(255) : full url
//  uid int(5) : submitter
//  time_create int(10)
//  time_update int(10)
//  hits int(11)
//  rating double(6,4)
//  votes int(11)
//  comments int(11)
//  description text
//  search text default
//  passwd varchar(255)
//  name varchar(255)
//  nameflag tinyint(2)
//  mail varchar(255)
//  mailflag tinyint(2)
//  company varchar(255)
//  addr varchar(255)
//  tel varchar(255)
//  admincomment text
//  width  int(5)
//  height int(5)
//  recommend tinyint(2)
//  mutual    tinyint(2)
//  broken int(11)
//  rss_url  varchar(255)
//  rss_flag tinyint(3)
//  rss_xml  mediumtext
//  rss_update int(10)
//  usercomment text
//  zip    varchar(100)
//  state  varchar(100)
//  city   varchar(100)
//  addr2  varchar(255)
//  fax    varchar(255)

// --- rssc ---
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  title  varchar(255)
//  url    varchar(255)
//  refresh   mediumint(8)
//  headline  mediumint(8)
//  mode      tinyint(3)
//  rdf_url   varchar(255)
//  rss_url   varchar(255)
//  atom_url  varchar(255)
//  encoding  varchar(15)
//  updated_unix int(10)
//  channel text
//  xml  mediumtext
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 4: import link table</h4>\n";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$next = $offset + $this->_LIMIT;

	$sql1  = "SELECT count(*) FROM ".$this->_table_weblinks_link;
	$sql1 .= " WHERE ( rss_flag=1 OR rss_flag=2 )";

	$res1  =& $this->query($sql1);
	$row1  =& $this->_db->fetchRow($res1);
	$total =  $row1[0];

	echo "There are <b>".$total."</b> rss links in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$sql2  = "SELECT * FROM ".$this->_table_weblinks_link;
	$sql2 .= " WHERE ( rss_flag=1 OR rss_flag=2 ) ORDER BY lid";

	$res2  =& $this->query($sql2, $this->_LIMIT, $offset);

	while ($row2 = $this->_db->fetchArray($res2))
	{
		$lid   = $row2['lid'];
		$url   = $row2['url'];
		$url2  = $row2['rss_url'];
		$title = $row2['title'];
		$uid   = $row2['uid'];

		echo $lid.": ".htmlspecialchars($title);

		if ($this->_exist_url($url) || $this->_exist_url($url2))
		{
			echo " <b>skip</b> <br />\n";
			continue;
		}

		echo " <br />\n";

		$p1       = $lid;	// store lid;
		$rss_url  = '';
		$atom_url = '';

		switch ( $row2['rss_flag'] )
		{
			case 1:
				$mode    = 2;	// rss
				$rss_url = $url2;
				break;

			case 2:
				$mode     = 3;	// atom
				$atom_url = $url2;
				break;

			default:
				$mode = 4;	// auto
				break;
		}

		$link_obj =& $this->_link_handler->create();

		$link_obj->set('uid',      1 );	// admin
		$link_obj->set('mid',      $this->_mid );
		$link_obj->set('mode',     $mode );
		$link_obj->set('refresh',  86400 );	// 24 hours
		$link_obj->set('p1',       $p1 );
		$link_obj->setVar('title',    $title,    true );
		$link_obj->setVar('url',      $url,      true );
		$link_obj->setVar('rss_url',  $rss_url,  true );
		$link_obj->setVar('atom_url', $atom_url,  true );

		$this->_link_handler->insert($link_obj);
		unset($link_obj);
	}

	if ( $total > $next )
	{
		$this->_form_link($next);
	}
	else
	{
		$this->_form_feed();
	}

}


function import_feed()
{
// === feed table ===

// --- weblinks ---
//  aid int(11)
//  lid int(11)
//  site_title varchar(100)
//  site_url   varchar(255)
//  title varchar(100)
//  url   varchar(255)
//  entry_id   varchar(255)
//  guid       varchar(255)
//  time_modified int(10)
//  time_issued   int(10)
//  time_created  int(10)
//  author_name  varchar(100)
//  author_url   varchar(255)
//  author_email varchar(255)
//  content text

// --- rssc ---
//  fid int(11)
//  lid int(11)
//  uid int(11)
//  mid int(11)
//  p1  int(11)
//  p2  int(11)
//  p3  int(11)
//  site_title varchar(255)
//  site_link  varchar(255)
//  title  varchar(255)
//  link   varchar(255)
//  entry_id  varchar(255)
//  guid      varchar(255)
//  updated_unix   int(10)
//  published_unix int(10)
//  category  varchar(255)
//  author_name  varchar(255)
//  author_uri   varchar(255)
//  author_email varchar(255)
//  type_cont    varchar(255)
//  raws    text
//  content text
//  search  text
//  aux_int_1 int(5)
//  aux_int_2 int(5)
//  aux_text_1 varchar(255)
//  aux_text_2 varchar(255)

	echo "<h4>STEP 5: import feed table</h4>\n";

	$offset = 0;
	if ( isset($_POST['offset']) )  $offset = $_POST['offset'];

	$next = $offset + $this->_LIMIT;
	$this->_set_lid_list();

	$sql1  =  "SELECT count(*) FROM ".$this->_table_weblinks_feed;
	$res1  =& $this->query($sql1);
	$row1  =& $this->_db->fetchRow($res1);
	$total =  $row1[0];

	echo "There are <b>".$total."</b> feeds in weblinks<br />\n";
	echo "Transfer ".$offset." - ".$next." record <br /><br />\n";

	$sql2  = "SELECT * FROM ".$this->_table_weblinks_feed;
	$sql2 .= " ORDER BY aid";
	$res2  =& $this->query($sql2, $this->_LIMIT, $offset);

	while ($row2 = $this->_db->fetchArray($res2))
	{
		$aid   = $row2['aid'];
		$title = $row2['title'];
		$link  = $row2['url'];

		echo $aid.": ".htmlspecialchars($title);

		if ( $this->_exist_feed($link) )
		{
			echo " <b>skip</b> <br />\n";
			continue;
		}

		echo " <br />\n";

		$lid = $this->_get_feed_lid( $row2 );
		$uid = $this->_get_feed_uid( $lid );
		$p1  = $this->_get_feed_p1(  $lid );
		$site_title     = $row2['site_title'];
		$site_link      = $row2['site_url'];
		$entry_id       = $row2['entry_id'];
		$guid           = $row2['guid'];
		$updated_unix   = $row2['time_modified'];
		$published_unix = $row2['time_issued'];
		$author_name    = $row2['author_name'];
		$author_uri     = $row2['author_url'];
		$author_email   = $row2['author_email'];
		$content        = $row2['content'];

		$feed_obj =& $this->_feed_handler->create();

		$feed_obj->set('lid', $lid );
		$feed_obj->set('uid', $uid );
		$feed_obj->set('mid', $this->_mid );
		$feed_obj->set('p1',  $p1 );
		$feed_obj->set('updated_unix',   $updated_unix );
		$feed_obj->set('published_unix', $published_unix );
		$feed_obj->setVar('site_title',   $site_title,   true );
		$feed_obj->setVar('site_link',    $site_link,    true );
		$feed_obj->setVar('title',        $title,        true );
		$feed_obj->setVar('link',         $link,         true );
		$feed_obj->setVar('entry_id',     $entry_id,     true );
		$feed_obj->setVar('guid',         $guid,         true );
		$feed_obj->setVar('author_name',  $author_name,  true );
		$feed_obj->setVar('author_uri',   $author_uri,   true );
		$feed_obj->setVar('author_email', $author_email, true );
		$feed_obj->setVar('content',      $content,      true );
		$feed_obj->set_search();

		$this->_feed_handler->insert($feed_obj);
		unset($feed_obj);
	}

	if ( $total > $next )
	{
		$this->_form_feed($next);
	}
	else
	{
		$this->_print_finish();
	}

}

//=========================================================
// private
//=========================================================
function _get_weblinks_list($key)
{
	$sql  =  "SELECT * FROM ".$this->_table_weblinks_config;
	$res  =& $this->query($sql);
	$row  =& $this->_db->fetchArray($res);
	$list = $this->_strings->convert_string_to_array($row[$key], "\n");

	return $list;
}

function _get_weblinks_mid()
{
	$ret = $this->_system->get_mid_by_dirname( $this->_DIRNAME_WEBLINKS );
	return $ret;
}

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
echo "Import DB weblinks 0.96 to rssc 0.30 <br /><br />\n";

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
		$import->import_site();
	}
	break;

case "import_black":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_black();
	}
	break;

case "import_white":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_white();
	}
	break;

case "import_link":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_link();
	}
	break;

case "import_feed":
	if( !$import->check_token() ) 
	{
		xoops_error("Token Error");
	}
	else
	{
		$import->import_feed();
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