<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to switch among languages
 */
class Language extends MY_Controller {

	public function set($abbr)
	{
		// check with available options inside: application/config/language.php
		if ( array_key_exists($abbr, $this->mAvailableLanguages) )
		{
			// save selected language to session
			$this->session->set_userdata('language', $abbr);
		}
		
		$this->load->library('user_agent');
		redirect($this->agent->referrer());
	}
}
