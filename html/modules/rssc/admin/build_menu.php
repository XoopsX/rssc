<?php
// $Id: build_menu.php,v 1.1 2011/12/29 14:37:10 ohwada Exp $

// 2007-11-01 K.OHWADA
// rss_cache_clear()
// rssc_admin_print_footer()

// 2006-06-04 K.OHWADA
// this is new file
// move from rss.php

//================================================================
// Rss center Module
// 2006-06-04 K.OHWADA
//================================================================

include 'admin_header_config.php';

// class
$config_form  =& admin_config_form::getInstance();
$config_store =& admin_config_store::getInstance();

$op = $config_form->get_post_get_op();

if ($op == 'rss_cache_clear')
{
	if( !$config_form->check_token() ) 
	{
		xoops_cp_header();
		$config_form->print_xoops_token_error();
	}
	else
	{
		$config_store->rss_cache_clear();
		redirect_header("build_menu.php", 1, _HAPPY_LINUX_CLEARED );
	}
}
else
{
	xoops_cp_header();
}

rssc_admin_print_header();
rssc_admin_print_menu();

admin_print_build_menu();

echo "<h4>"._HAPPY_LINUX_CONF_RSS_CACHE_CLEAR."</h4>\n";
$config_form->show_form_rss_cache_clear( _HAPPY_LINUX_CONF_RSS_CACHE_CLEAR );

rssc_admin_print_footer();
xoops_cp_footer();
exit();
// --- main end ---


function admin_print_build_menu()
{

echo "<h3>". _HAPPY_LINUX_CONF_RSS_MANAGE. "</h3>\n";
echo _HAPPY_LINUX_CONF_RSS_MANAGE_DESC. "<br /><br />\n";
echo "<ul>\n";
echo '<li><a href="build_rss.php?mode=rdf" target="_blank">';
echo '<img src="'. RSSC_URL .'/images/rdf.png"> ';
echo _HAPPY_LINUX_CONF_DEBUG_RDF;
echo "</a><br /><br /></li>\n";
echo '<li><a href="build_rss.php?mode=rss" target="_blank">';
echo '<img src="'. RSSC_URL .'/images/rss.png"> ';
echo _HAPPY_LINUX_CONF_DEBUG_RSS;
echo "</a><br /><br /></li>\n";
echo '<li><a href="build_rss.php?mode=atom" target="_blank">';
echo '<img src="'. RSSC_URL .'/images/atom.png"> ';
echo _HAPPY_LINUX_CONF_DEBUG_ATOM;
echo "</a><br /><br /></li>\n";
echo "</ul>\n";

}

?>