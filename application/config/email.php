<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Email Settings
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

// $config['protocol'] = 'smtp';
// $config['smtp_host'] = 'smtp.mandrillapp.com';
// $config['smtp_port'] = '587';
// $config['smtp_timeout'] = '30';
// $config['smtp_user'] = 'username';
// $config['smtp_pass'] = 'password';
// $config['charset'] = 'utf-8';
// $config['mailtype'] = 'html';
// $config['wordwrap'] = TRUE;
// $config['newline'] = "\r\n";

// // custom values from CI Bootstrap
// $config['from_email'] = "noreply@email.com";
// $config['from_name'] = "CI Bootstrap";
// $config['subject_prefix'] = "[CI Bootstrap] ";

// // Mailgun API (to be used in Email Client library)
// $config['mailgun'] = array(
// 	'domain'				=> '',
// 	'private_api_key'		=> '',
// );

$config['protocol']    = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user']	='info@inahrs.or.id';
$config['smtp_pass']	='Inahrs@2015';

$config['charset']    = 'utf-8';
// $config['newline']    = "\r\n";
$config['mailtype'] = 'text'; // or html
$config['validation'] = TRUE;