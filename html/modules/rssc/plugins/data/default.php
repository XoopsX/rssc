<?php
// $Id: default.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

// --- rssc_plugin_data_default begin ---
if( !function_exists( 'rssc_plugin_data_default' ) ) 
{

function rssc_plugin_data_default()
{
	$content = '
<h1>exsample</h1>
<h4>div tag</h4>
<div align="center">this is content</div>
<h4>a tag</h4>
<a href="'. XOOPS_URL .'/modules/logo.gif">
link to image
</a>
<h4>img tag</h4>
<img src="'. XOOPS_URL .'/modules/logo.gif">
<h4>img tag</h4>
';

	$arr = array(
		'fid' => 234,
		'lid' => 345,
		'uid' => 1,
		'mid' => 123,
		'p1'  => 11,
		'p2'  => 22,
		'p3'  => 33,
		'act' => 1,
		'site_title' => 'exsample.com',
		'site_link'  => 'http://exsample.com/',
		'title'      => 'exsample',
		'link'       => 'http://exsample.com/exsample.html',
		'entry_id'   => 'tag:exsample.com,2008://1.2.3',
		'guid'       => 'tag:exsample.com:exsample.html',
		'updated_unix'   => 1201098225,
		'published_unix' => 1201018225,
		'category'     => 'category',
		'author_name'  => 'webmaster',
		'author_uri'   => 'http://exsample.com/author.html',
		'author_email' => 'webmaster@exsample.com',
		'type_cont'    => '',
		'raws'   => '',
		'search' => 'this is search field',
		'enclosure_url'    => 'http://exsample.com/exsample.mp3',
		'enclosure_type'   => 'audio/mpeg',
		'enclosure_length' => '123456',
		'aux_int_1'  => 111,
		'aux_int_2'  => 222,
		'aux_text_1' => 'aux text 1',
		'aux_text_2' => 'aux text 2',
		'content'    => $content,
	);

	return array( $arr );
}

// --- rssc_plugin_data_default end ---
}

?>