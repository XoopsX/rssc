$Id: readme_en.txt,v 1.1 2011/12/29 14:37:12 ohwada Exp $

=================================================
how to make plugin
=================================================

"foobar" is exsample plugin name

1. exsapmple for plugin

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
	// write in English
	return "this is foobar description";
}

function convert()
{
	$content = $this->get_value_by_key( 'content' );
	$converted = xxx;	// please write your proccess
	$this->set_value_by_key( 'content', $converted );
	return true;
}

} // class end
} // class_exists end
-----

2. exsapmple for plugin description in local language

plugins/language/LOCAL_LANGUAGE_NAME/foobar.php
-----
// write in local language
$rssc_plugin_description = "xxx";
-----
