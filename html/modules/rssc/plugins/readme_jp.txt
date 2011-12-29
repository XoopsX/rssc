$Id: readme_jp.txt,v 1.1 2011/12/29 14:37:12 ohwada Exp $

=================================================
プラグインの作り方
=================================================

プラグイン名を "foobar" とします

1. プラグインの記述例

plugins/foobar.php
------
if( !class_exists('rssc_plugin_foobar') ) 
{

class rssc_plugin_foobar extends rssc_plugin_base
{

function rssc_plugin_foobar()
{
	$this->rssc_plugin_base();
}

function description()
{
	// ここは英語の説明文
	return "this is foobar description";
}

function convert()
{
	$content = $this->get_value_by_key( 'content' );
	$converted = xxx;	// ここに変換処理を書く
	$this->set_value_by_key( 'content', $converted );
	return true;
}

} // class の終わり
} // class_exists の終わり
-----

2. 日本語の説明文の記述例

plugins/language/japanese/foobar.php
-----
$rssc_plugin_description = "これは foobar の説明文です";
-----
