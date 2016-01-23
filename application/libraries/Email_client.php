<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to send out email using HTTP API (instead of SMTP from CodeIgniter)
 */
class Email_client {

	protected $CI;
	protected $mPlatform;

	public function __construct($platform = 'mailgun')
	{
		$this->mPlatform = $platform;
		$this->CI =& get_instance();
		$this->CI->config->load('email');
	}

	public function set_platform($platform)
	{
		$this->mPlatform = $platform;
	}
	
	public function send($to_email, $subject, $view, $view_data = NULL)
	{
		switch ($this->mPlatform)
		{
			// Reference: https://github.com/mailgun/mailgun-php
			case 'mailgun':

				// create Mailgun object
				$platform_config = $this->CI->config->item($this->mPlatform);
				$api_key = $platform_config['private_api_key'];
				$domain = $platform_config['domain'];
				$from_email = $this->CI->config->item('from_email');
				$from_name = $this->CI->config->item('from_name');
				$mg = new Mailgun\Mailgun($api_key);

				// get HTML content from view
				$view_data['from_name'] = $from_name;
				$html = $this->CI->load->view($view, $view_data, TRUE);

				// prepend subject
				$subject = $this->CI->config->item('subject_prefix').$subject;

				// Mailgun MessageBuilder
				// Reference: https://github.com/mailgun/mailgun-php/blob/master/src/Mailgun/Messages/README.md
				$mb = $mg->MessageBuilder();
				$mb->setFromAddress($from_email, $from_name);
				$mb->addToRecipient($to_email);
				$mb->setSubject($subject);
				$mb->setHtmlBody($html);

				// confirm to send message
				$mg->post("{$domain}/messages", $mb->getMessage());
				break;
		}
	}
}