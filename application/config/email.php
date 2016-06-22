<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Email Settings
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.mailgun.org';
$config['smtp_port'] = '587';
$config['smtp_timeout'] = '30';
$config['smtp_user'] = 'postmaster@yourdomain.com';
$config['smtp_pass'] = 'password';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
