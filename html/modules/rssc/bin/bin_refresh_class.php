<?php
// $Id: bin_refresh_class.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

// 2007-06-10 K.OHWADA
// command parameter: limit offset

// 2007-05-20 K.OHWADA
// change check()

// 2006-07-10 K.OHWADA
// use happy_linux_bin_base

// 2006-07-01 K.OHWADA
// BUG 4083: The command line of refreshed links are limited to 10 sites.

// 2006-06-04 K.OHWADA
// not use xoopsConfig
// suppress notice : Only variable references should be returned by reference

//=========================================================
// Rss center Module
// 2006-01-01 K.OHWADA
//=========================================================
class bin_refresh extends happy_linux_bin_base
{
// class Instant
	var $_refresh;
	var $_config;

// constant
	var $_MAILER          = 'XOOPS rssc';
	var $_TITLE           = 'refresh archive';
	var $_FILENAME_RESULT = 'cache/refresh_link.html';

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function bin_refresh( $dirname )
{
	$this->happy_linux_bin_base( $dirname );
	$this->set_mailer( $this->_MAILER );
	$this->set_filename( 'modules/'.$dirname.'/'.$this->_FILENAME_RESULT );

// class Instant
	$this->_refresh =& rssc_get_handler( 'refresh_all',  $dirname );
	$this->_config  =& rssc_get_handler( 'config_basic', $dirname );
}

//=========================================================
// public
//=========================================================
function refresh()
{
	$conf_data  =& $this->_config->get_conf();
	$feed_limit =  $conf_data['basic_feed_limit'];
	$word_limit =  $conf_data['word_limit'];
	$pass       =  $conf_data['bin_pass'];
	$mailto     =  $conf_data['bin_mailto'];
	$flag_send  =  $conf_data['bin_send'];

	$this->set_env_param();

	if ( !$this->check_pass($pass) )
	{
		return false;
	}

	$this->_refresh->set_feed_limit($feed_limit);
	$this->_refresh->set_word_limit($word_limit);
	$this->_refresh->set_flag_print($this->_flag_print);
	$this->_refresh->set_flag_chmod($this->_flag_chmod);
	$this->_refresh->set_flag_write($this->_flag_write);

// --- file open ---
	$this->_refresh->open_bin( $this->get_filename() );
	$this->_refresh->print_write_data( $this->_get_html_header() );

	$this->_refresh->refresh($this->_limit, $this->_offset);

	$this->_refresh->print_write_data( $this->_get_html_footer() );
	$this->_refresh->close_bin();
// --- file close ---

	if ($flag_send)
	{
		$total       = $this->_refresh->get_total();
		$num_broken  = $this->_refresh->get_count_broken();
		$num_feed    = $this->_refresh->get_count_feed();

// mail
		$text = <<<END_OF_TEXT
total  links:  $total
broken links:  $num_broken
refresh feeds: $num_feed
END_OF_TEXT;

		$this->_send_mail($mailto, $this->_TITLE, $text);
	}

	return true;
}

// --- class end ---
}

?>