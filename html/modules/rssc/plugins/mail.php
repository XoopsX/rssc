<?php
// $Id: mail.php,v 1.1 2011/12/29 14:37:12 ohwada Exp $

//=========================================================
// Rss Center Module
// 2008-01-20 K.OHWADA
//=========================================================

//---------------------------------------------------------
// name: mail
// description: send content to address by mail
// param:
//   0: adderss, ex) 'webmaster@exsample.com'
//   1: subject, ex) 'mail subject'
//---------------------------------------------------------

// === class begin ===
if( !class_exists('rssc_plugin_mail') ) 
{

class rssc_plugin_mail extends rssc_plugin_base
{

//---------------------------------------------------------
// constructor
//---------------------------------------------------------
function rssc_plugin_mail()
{
	$this->rssc_plugin_base();
}

//---------------------------------------------------------
// function
//---------------------------------------------------------
function description()
{
	return 'send content to address by mail';
}

function usage()
{
	return 'mail ( address, [subject] )';
}

function execute( &$items )
{
	$happy_linux_system =& happy_linux_system::getInstance();

// assume to implode one item
	$this->set_plural_item_array( $items );
	$this->set_item_array( $this->get_plural_item_by_num(0) );

	$address = $this->get_param_by_num(0);
	$subject = $this->get_param_by_num(1);

	$sitename  = $happy_linux_system->get_sitename();
	$adminmail = $happy_linux_system->get_adminmail();

	if ( empty($address) )
	{
		$this->set_logs( 'mail: no address' );
		return false;
	}

	if ( empty($subject) )
	{
		$subject = $sitename;
	}

	$body  = $subject."\n\n";
	$body .= $this->get_item_by_key('content');
	$body .= "\n\n";
	$body .= "----- \n";
	$body .= $sitename."\n";
	$body .= $adminmail."\n";

	$mailer =& getMailer();

	$mailer->setToEmails(  $address );
	$mailer->setSubject(   $subject );
	$mailer->setBody(      $body );
	$mailer->setFromEmail( $adminmail );
	$mailer->useMail();	

	$ret = $mailer->send();
	if ( !$ret )
	{
		$this->set_logs( $mailer->getErrors(0) );
	}

	return $items;
}

// --- class end ---
}

// === class end ===
}

?>