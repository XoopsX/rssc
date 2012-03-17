<?php
// $Id: admin_function.php,v 1.2 2012/03/17 13:31:45 ohwada Exp $

// 2012-03-01 K.OHWADA
// map_manage.php

// 2008-01-20 K.OHWADA
// config_manage_3.php

// 2007-11-24 K.OHWADA
// _HAPPY_LINUX_CONF_TABLE_MANAGE

// 2007-11-11 K.OHWADA
// happy_linux_admin_menu
// modules.php

// 2007-06-01 K.OHWADA
// menu: word_manage blocks

// 2006-09-20 K.OHWADA
// use build_html_menu_table()
// add table_manage
// add rssc_admin_print_bread()

// 2006-06-04 K.OHWADA
// change to contant RSSC_DIRNAME
// remove rssc_admin_get_dirname()

// 2006-04-17 K.OHWADA
// suppress notice : Only variable references should be returned by reference

//=========================================================
// RSS Center Module
// 2006-01-01 K.OHWADA
//=========================================================
function rssc_admin_print_header()
{
	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_header( RSSC_DIRNAME, _MI_RSSC_DESC );
}

function rssc_admin_print_footer()
{
	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_footer();
}

function rssc_admin_print_powerdby()
{
	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_powerdby();
}

function rssc_admin_print_bread( $name1, $url1='', $name2='' )
{
	$system =& happy_linux_system::getInstance();
	$form   =& happy_linux_form::getInstance();

	$arr = array(
		array(
			'name' => $system->get_module_name(),
			'url'  => 'index.php',
		),
	);

	if ( $name1 )
	{
		$arr[] = array(
			'name' => $name1,
			'url'  => $url1,
		);
	}

	if ( $name2 )
	{
		$arr[] = array(
			'name' => $name2,
		);
	}

	echo $form->build_html_bread_crumb( $arr );
}

function rssc_admin_print_menu()
{
	$MAX_COL = 5;

	$link_handler  =& rssc_get_handler('link',  RSSC_DIRNAME);
	$black_handler =& rssc_get_handler('black', RSSC_DIRNAME);
	$white_handler =& rssc_get_handler('white', RSSC_DIRNAME);
	$feed_handler  =& rssc_get_handler('feed',  RSSC_DIRNAME);
	$word_handler  =& rssc_get_handler('word',  RSSC_DIRNAME);

	$total_link  = $link_handler->getCount();
	$total_black = $black_handler->getCount();
	$total_white = $white_handler->getCount();
	$total_feed  = $feed_handler->getCount();
	$total_word  = $word_handler->getCount();

	$link_list  = _AM_RSSC_LIST_LINK. " ($total_link)";
	$black_list = _AM_RSSC_LIST_BLACK." ($total_black)";
	$white_list = _AM_RSSC_LIST_WHITE." ($total_white)";
	$feed_list  = _AM_RSSC_LIST_FEED. " ($total_feed)";
	$word_list  = _AM_RSSC_LIST_WORD. " ($total_word)";

	$menu_arr = array(
		_MI_RSSC_ADMENU_CONFIG       => 'index.php',
		_AM_RSSC_FORM_FILTER         => 'config_manage_2.php',
		_AM_RSSC_FORM_HTMLOUT        => 'config_manage_3.php',
		_AM_RSSC_FORM_CUSTOM_PLUGIN  => 'config_manage_4.php',
		_RSSC_PLUGIN_LIST            => 'plugin_list.php',

		$link_list   => 'link_list.php',
		$black_list  => 'black_list.php',
		$white_list  => 'white_list.php',
		$word_list   => 'word_list.php',
		$feed_list   => 'feed_list.php',

		_AM_RSSC_ADD_LINK    => 'link_manage.php',
		_AM_RSSC_ADD_BLACK   => 'black_manage.php',
		_AM_RSSC_ADD_WHITE   => 'white_manage.php',
		_AM_RSSC_ADD_WORD    => 'word_manage.php',
		_AM_RSSC_ADD_KEYWORD => 'keyword_manage.php',

		_HAPPY_LINUX_CONF_COMMAND_MANAGE => 'command_manage.php',
		_AM_RSSC_UPDATE_MANAGE           => 'update_manage.php',
		_AM_RSSC_ARCHIVE_MANAGE          => 'archive_manage.php',
		_HAPPY_LINUX_CONF_RSS_MANAGE     => 'build_menu.php',
		_AM_RSSC_PARSE_RSS               => 'parse_rss.php',

		_HAPPY_LINUX_CONF_TABLE_MANAGE => 'table_manage.php',
		_HAPPY_LINUX_AM_MODULE         => 'modules.php',
		_HAPPY_LINUX_AM_BLOCK          => 'blocks.php',
		_AM_RSSC_MAP_MANAGE            => 'map_manage.php',
		_HAPPY_LINUX_GOTO_MODULE => '../index.php',

	);

	$menu =& happy_linux_admin_menu::getInstance();
	echo $menu->build_menu_table($menu_arr, $MAX_COL);
}

?>