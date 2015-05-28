<?php

/**
 * http://www.codeigniter.com/user_guide/libraries/email.html
 */

// Send email using config (overriding CodeIgniter send_email() function)
// Configuration file: application/config/email.php
function send_email($to_email, $to_name, $subject, $view, $view_data = NULL)
{
	// load values from config
	$CI =& get_instance();
	$CI->load->library('email');
	$CI->config->load('email');
	$from_email = $CI->config->item('from_email');
	$from_name = $CI->config->item('from_name');
	$subject = $CI->config->item('subject_prefix').$subject;

	// basic parameters
	$CI->email->from($from_email, $from_name);
	$CI->email->to($to_email, $to_name);
	$CI->email->subject($subject);
	//$CI->email->cc($from_email, $from_name);
	//$CI->email->reply_to($from_email, $from_name);
	
	// confirm to send
	$msg = $CI->load->view('email/'.$view, $view_data, TRUE);
	$CI->email->message($msg);

	if (ENVIRONMENT=='development')
	{
		$CI->email->send(FALSE);
		echo $CI->email->print_debugger();
	}
	else
	{
		$CI->email->send();
	}
}