<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller to switch among languages
 */
class Locale extends Frontend_Controller {

	public function set($locale)
	{
		// check with available options inside: application/config/locale.php
		if ( array_key_exists($locale, $this->mAvailableLocales) )
		{
			// save selected language to session
			$this->session->set_userdata('locale', $locale);
		}
		
		$this->load->library('user_agent');
		redirect($this->agent->referrer());
	}
}
