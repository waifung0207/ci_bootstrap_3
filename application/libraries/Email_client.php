<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to send out email using HTTP API (instead of SMTP)
 */
class Email_client {

	protected $CI;
	protected $mPlatform;
	protected $mConfig;

	public function __construct($platform = 'mailgun')
	{
		$this->mPlatform = $platform;
		$this->CI =& get_instance();
		$this->CI->load->config('email');
		$this->mConfig = $this->CI->config->item($platform);
	}

	public function send($to_email, $subject, $view, $view_data = NULL)
	{
		switch ($this->mPlatform)
		{
			// Reference: https://github.com/mailgun/mailgun-php
			case 'mailgun':

				// create Mailgun object
				$api_key = $this->mConfig['private_api_key'];
				$domain = $this->mConfig['domain'];
				$from_email = $this->mConfig['from_email'];
				$mg = new Mailgun\Mailgun($api_key);

				// get HTML content from view
				$html = $this->CI->load->view($view, $view_data, TRUE);

				// Mailgun MessageBuilder
				// Reference: https://github.com/mailgun/mailgun-php/blob/master/src/Mailgun/Messages/README.md
				$mb = $mg->MessageBuilder();
				$mb->setFromAddress($from_email);
				$mb->addToRecipient($to_email);
				$mb->setSubject($subject);
				$mb->setHtmlBody($html);

				// confirm to send message
				$mg->post("{$domain}/messages", $mb->getMessage());
				break;
		}
	}
}