<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to build form efficiently with following features:
 * 	- render form with Bootstrap theme (support Vertical form only at this moment)
 * 	- reduce effort to repeated create labels, setting placeholder, etc. with flexibility
 * 	- shortcut functions to append form elements (currently support: text, password, textarea, submit)
 * 	- help with form validation and provide inline error to each field
 * 	- automatically restore "value" to fields when validation failed (using CodeIgniter set_value() function)
 *
 * TODO:
 * 	- support more field types (checkbox, dropdown, upload, etc.)
 * 	- automatically set "required" fields (matching with rule set)
 * 	- fix inline error handling (after refactoring to use flashdata error)
 */
class Form_builder {

	protected $mFormCount = 0;

	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->helper('form');
		$CI->load->library('form_validation');
		$CI->load->config('form_validation');
	}

	// Initialize a form and return the object
	public function create_form($url = NULL, $multipart = FALSE, $attributes = array())
	{
		$url = ($url===NULL) ? current_url() : $url;
		$form = new Form($url, $multipart, $attributes);
		$this->mFormCount++;
		$form->set_id($this->mFormCount);
		return $form;
	}
}

/**
 * Class to store components appear on a form
 */
class Form {

	protected $CI;

	protected $mPostUrl;			// target POST URL
	protected $mFormUrl;			// URL to display form (default: same as $mPostUrl)
	protected $mRuleGroup;			// name of validation rule group (match with keys inside application/config/form_validation.php)
	protected $mMultipart;			// whether the form supports multipart
	protected $mAttributes;

	// state whether the form contains reCAPTCHA
	protected $mRecaptchaAdded;

	// session key to store field data before redirection
	protected $mFormData;
	protected $mSessionKey;

	// Constructor
	public function __construct($url, $multipart, $attributes)
	{
		$this->CI =& get_instance();
		$this->CI->load->library('system_message');

		$this->mPostUrl = $url;
		$this->mFormUrl = $url;
		$this->mMultipart = $multipart;
		$this->mAttributes = $attributes;
	}

	// Update form ID and according data from session (to support multiple forms on one page)
	public function set_id($id)
	{
		$this->mSessionKey = 'form-'.$id;
		$this->mFormData = $this->CI->session->flashdata($this->mSessionKey);
	}

	// Update Rule Group for validation
	// Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html#calling-a-specific-rule-group
	public function set_rule_group($rule_group)
	{
		$this->mRuleGroup = $rule_group;
	}

	// Update target URL:
	// 	- $this->mPostUrl = the page where the form is submitted to (i.e. "action" attribute of the form)
	// 	- $this->mFormUrl = the page where the form is located at (for redirection when failed)
	public function set_post_url($url)
	{
		$this->mPostUrl = $url;
	}
	public function set_form_url($url)
	{
		$this->mFormUrl = $url;
	}

	// Render form open tag
	public function open()
	{
		if ($this->mMultipart)
			return form_open_multipart($this->mPostUrl, $this->mAttributes);
		else
			return form_open($this->mPostUrl, $this->mAttributes);
	}

	// Render form close tag
	public function close()
	{
		return form_close();
	}

	// Get saved value for single field
	public function get_field_value($name)
	{
		return isset($this->mFormData[$name]) ? $this->mFormData[$name] : set_value($name);
	}

	/**
	 * Basic fields
	 */
	// Input field (type = text)
	public function field_text($name, $value = NULL, $extra = array())
	{
		$data = array('type' => 'text', 'id' => $name, 'name' => $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_input($data, $value, $extra);
	}

	// Input field (type = email)
	public function field_email($name = 'email', $value = NULL, $extra = array())
	{
		$data = array('type' => 'email', 'id' => $name, 'name'	=> $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_input($data, $value, $extra);
	}

	// Password field
	public function field_password($name = 'password', $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? '' : $value;
		return form_password($data, $value, $extra);
	}

	// Textarea field
	public function field_textarea($name, $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_textarea($data, $value, $extra);
	}
	
	// Upload field
	public function field_upload($name, $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? $this->get_field_value($name) : $value;
		return form_upload($data, $value, $extra);
	}
	
	// Hidden field
	public function field_hidden($name, $value = NULL, $extra = array())
	{
		$data = array('id' => $name, 'name' => $name);
		$value = ($value===NULL) ? '' : $value;
		return form_hidden($data, $value, $extra);
	}

	// Dropdown field
	public function field_dropdown($name, $options = array(), $selected = array(), $extra = array())
	{
		return form_dropdown($name, $options, $selected, $extra);
	}

	/**
	 * reCAPTCHA
	 */
	public function field_recaptcha()
	{
		$config = $this->CI->config->item('recaptcha');
		$site_key = $config['site_key'];
		$this->mRecaptchaAdded = TRUE;
		return '<div class="g-recaptcha" data-sitekey="'.$site_key.'"></div>';
	}
	
	/**
	 * Buttons
	 */
	// Submit button
	public function btn_submit($label, $extra = array())
	{
		$data = array('type' => 'submit');
		return form_button($data, $label, $extra);
	}

	// Reset button
	public function btn_reset($label, $extra = array())
	{
		$data = array('type' => 'reset');
		return form_button($data, $label, $extra);
	}

	/**
	 * Bootstrap 3 functions
	 */
	public function bs3_text($label, $name, $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_text($name, $value, $extra).'</div>';
	}

	public function bs3_email($label, $name = 'email', $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_email($name, $value, $extra).'</div>';
	}

	public function bs3_password($label, $name = 'password', $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_password($name, $value, $extra).'</div>';
	}

	public function bs3_textarea($label, $name, $value = NULL, $extra = array())
	{
		$extra['class'] = 'form-control';
		return '<div class="form-group">'.form_label($label, $name).$this->field_textarea($name, $value, $extra).'</div>';
	}

	public function bs3_submit($label, $style = 'primary', $extra = array())
	{
		$extra['class'] = 'btn btn-'.$style;
		return $this->btn_submit($label, $extra);
	}

	/**
	 * Success / Error messages
	 */
	public function messages()
	{
		return $this->CI->system_message->render();
	}

	/**
	 * Form Validation
	 */
	public function validate()
	{
		// only run validation upon form submission
		$post_data = $this->CI->input->post();
		if ( !empty($post_data) )
		{
			// Step 1. reCAPTCHA verification (skipped in development mode)
			if ( $this->mRecaptchaAdded && ENVIRONMENT!='development' )
			{
				$config = $this->CI->config->item('recaptcha');
				$secret_key = $config['secret_key'];
				$recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
				$resp = $recaptcha->verify($this->CI->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

				if (!$resp->isSuccess())
				{
					// save POST data to flashdata
					$this->CI->session->set_flashdata($this->mSessionKey, $post_data);

					// failed
					//$errors = $resp->getErrorCodes();
					$this->CI->system_message->set_error('ReCAPTCHA failed.');

					// redirect to form page (interrupt other operations)
					$this->CI->system_message->save();
					redirect($this->mFormUrl);
				}
			}

			// Step 2. CodeIgniter form validation
			$result = $this->CI->form_validation->run($this->mRuleGroup);
			if ($result===FALSE)
			{
				// save POST data to flashdata
				$this->CI->session->set_flashdata($this->mSessionKey, $post_data);

				// store validation error message from CodeIgniter
				$this->CI->system_message->set_error(validation_errors());

				// redirect to form page (interrupt other operations)
				$this->CI->system_message->save();
				redirect($this->mFormUrl);
			}
			else
			{
				// return TRUE to indicate the result is positive
				$this->CI->system_message->set_success('Success');
				$this->CI->system_message->save();

				// TODO: handle case when there is no redirection upon success
				
				return TRUE;
			}
		}
	}
}