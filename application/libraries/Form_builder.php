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
 */
class Form_builder {

	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->library('form_validation');
	}

	// Initialize a form and return the object
	public function create_form($url, $inline_error = TRUE, $multipart = FALSE)
	{
		return new Form($url, $inline_error, $multipart);
	}
}

/**
 * Class to store components appear on a form
 */
class Form {

	protected $mAction;			// target POST url
	protected $mRuleSet;		// name of validation rule set (match with keys inside application/config/form_validation.php)
	protected $mInlineError;	// whether display inline error or not
	protected $mMultipart;		// whether the form supports multipart

	protected $mAttributes = array();		// attributes to pass into form tag
	protected $mType = 'default';			// form type (option: default / horizontal)
	protected $mColLeft = 'sm-2';			// left column width (for horizontal form only)
	protected $mColRight = 'sm-10';			// right column width (for horizontal form only)

	protected $mFields = array();			// elements stored in the Form object with ordering
	protected $mFooterHtml = '';			// custom HTML to render after other fields

	// Integration with reCAPTCHA (https://www.google.com/recaptcha/)
	// Keys to be edited in config file: application/config/form_validation.php
	protected $mRecaptchaAdded = FALSE;

	// store both validation and non-validation error messages
	protected $mErrorMsg = array();

	// store form result (either success or failed)
	protected $mFlashData = array();

	public function __construct($url, $inline_error, $multipart)
	{
		$this->mAction = $url;
		$this->mInlineError = $inline_error;
		$this->mMultipart = $multipart;

		$this->mErrorMsg['validation'] = '';
		$this->mErrorMsg['custom'] = array();

		$this->mFlashData['fields'] = array();
		$this->mFlashData['success'] = array();
		$this->mFlashData['danger'] = array();
	}

	// Update rule set (default is the same as $this->mAction)
	public function set_rule_set($rule_set)
	{
		$this->mRuleSet = $rule_set;
	}

	// Change form type to 'horizontal'
	public function set_horizontal($col_left = 'sm-2', $col_right = 'sm-10')
	{
		$this->mType = 'horizontal';
		$this->mAttributes['class'] = 'form-horizontal';
		$this->mColLeft = $col_left;
		$this->mColRight = $col_right;
	}

	// Append an text field
	public function add_text($name, $label = '', $placeholder = NULL, $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && ($placeholder===NULL) )
			$placeholder = $label;

		// set field values
		if ( !empty($this->mFlashData['fields'][$name]) )
			$value = $this->mFlashData['fields'][$name];
		else if ( empty($value) )
			$value = set_value($name);

		$field = array(
			'type'			=> ($name=='email') ? 'email' : 'text',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);

		$required = TRUE;
		if ($required)
			$field['required'] = TRUE;

		$this->mFields[$name] = $field;
		return $field;
	}

	// Append a password field
	public function add_password($name = 'password', $label = '', $placeholder = NULL, $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && ($placeholder===NULL) )
			$placeholder = $label;

		// value is set only during development mode for security reason
		if ( ENVIRONMENT!='development' )
			$value = '';

		$field = array(
			'type'			=> 'password',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);

		$required = TRUE;
		if ($required)
			$field['required'] = TRUE;

		$this->mFields[$name] = $field;
		return $field;
	}

	// Append a textarea field
	public function add_textarea($name, $label = '', $placeholder = NULL, $value = NULL, $rows = 5)
	{
		// automatically set placeholder
		if ( !empty($label) && ($placeholder===NULL) )
			$placeholder = $label;

		// set field values
		if ( !empty($this->mFlashData['fields'][$name]) )
			$value = $this->mFlashData['fields'][$name];
		else if ( empty($value) )
			$value = set_value($name);

		$field = array(
			'type'			=> 'textarea',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
			'rows'			=> $rows,
		);

		$required = TRUE;
		if ($required)
			$field['required'] = TRUE;

		$this->mFields[$name] = $field;
		return $field;
	}

	// Append a submit button
	public function add_submit($label = 'Submit', $style = 'primary', $block = FALSE)
	{
		$class = ($block) ? 'btn btn-block btn-'.$style : 'btn btn-'.$style;

		$this->mFields['submit'] = array(
			'type'			=> 'submit',
			'class'			=> $class,
			'label'			=> $label,
		);
	}

	// Append a hidden field
	public function add_hidden($name, $value)
	{
		$this->mFields[$name] = array(
			'type'			=> 'hidden',
			'name'			=> $name,
			'value'			=> $value,
		);
	}

	// Append reCAPTCHA (https://www.google.com/recaptcha/)
	public function add_recaptcha()
	{
		$this->mRecaptchaAdded = TRUE;
		$this->mFields['recaptcha'] = array('type' => 'recaptcha');
	}

	// Append HTML
	public function add_custom_html($html)
	{
		$this->mFields[] = array(
			'type'			=> 'custom',
			'content'		=> $html,
		);
	}

	// Append HTML (display at the very end of form, e.g. can be after Submit button)
	public function add_footer_html($html)
	{
		$this->mFooterHtml .= $html;
	}

	// Render a form field by passing its name
	public function render_field_by_name($name)
	{
		return empty($this->mFields[$name]) ? '' : $this->render_field($this->mFields[$name]);
	}

	// Render a form field by passing object
	public function render_field($field)
	{
		switch ($field['type'])
		{
			// Text field
			case 'text':
			case 'email':
				$data = array(
					'id'			=> $field['name'],
					'name'			=> $field['name'],
					'value'			=> $field['value'],
					'placeholder'	=> $field['placeholder'],
					'class'			=> 'form-control',
				);
				$control = form_input($data);
				return $this->form_group($field['name'], $control, $field['label']);

			// Password field
			case 'password':
				$data = array(
					'id'			=> $field['name'],
					'name'			=> $field['name'],
					'value'			=> $field['value'],
					'placeholder'	=> $field['placeholder'],
					'class'			=> 'form-control',
				);
				$control = form_password($data);
				return $this->form_group($field['name'], $control, $field['label']);

			// Textarea field
			case 'textarea':
				$data = array(
					'id'			=> $field['name'],
					'name'			=> $field['name'],
					'value'			=> $field['value'],
					'placeholder'	=> $field['placeholder'],
					'rows'			=> $field['rows'],
					'class'			=> 'form-control',
				);
				$control = form_textarea($data);
				return $this->form_group($field['name'], $control, $field['label']);

			// Select field
			case 'select':
				return '';

			// Checkbox field
			case 'checkbox':
				return '';

			// Radio field
			case 'radio':
				return '';

			// Upload field
			case 'upload':
				// to be completed
				return '';

			// reCAPTCHA field
			case 'recaptcha':
				return $this->form_group_recaptcha();

			// hidden field
			case 'hidden':
				return form_hidden($field['name'], $field['value']);

			// Custom HTMl
			case 'custom':
				return $field['content'];

			// Submit button
			case 'submit':
				return $this->form_group_submit($field['class'], $field['label']);
		}
	}

	// Render a complete form
	public function render()
	{
		if ($this->mMultipart)
			$str = form_open_multipart($this->mAction, $this->mAttributes);
		else
			$str = form_open($this->mAction, $this->mAttributes);

		// print out all fields
		foreach ($this->mFields as $field)
		{
			$str .= $this->render_field($field);
		}

		$str .= $this->mFooterHtml;
		$str .= form_close();
		return $str;
	}

	// Form group with control, label and error field
	public function form_group($name, $control, $label = '')
	{
		$error = form_error($name);
		$group_class = empty($error) ? '' : 'has-error';
		$group_open = '<div class="form-group '.$group_class.'">';
		$group_close = '</div>';
		
		// remove inline error message when necessary
		if (!$this->mInlineError)
			$error = '';

		// add asterisk after label for required field
		$required = !empty($this->mFields[$name]['required']);
		if ( !empty($label) && $required )
			$label.=' <span class="text-danger">*</span>';

		// handle form type (default / horizontal)
		switch ($this->mType)
		{
			case 'default':
				$label = empty($label) ? '' : form_label($label, $name);
				return $group_open.$label.$error.$control.$group_close;
			case 'horizontal':
				$label = empty($label) ? '' : form_label($label, $name, array('class' => 'control-label col-'.$this->mColLeft));
				$control = '<div class="col-'.$this->mColRight.'">'.$control.'</div>';
				$error = empty($error) ? '' : '<div class="col-'.$this->mColLeft.'"></div><div class="col-'.$this->mColRight.'">'.$error.'</div>';
				return $group_open.$error.$label.$control.$group_close;
			default:
				return '';
		}
	}

	// Form group with reCAPTCHA
	public function form_group_recaptcha()
	{
		$CI =& get_instance();
		$CI->load->config('form_validation');
		$site_key = $CI->config->item('recaptcha')['site_key'];

		$html = '<div class="form-group g-recaptcha" data-sitekey="'.$site_key.'"></div>';

		if ($this->mType=='horizontal')
			$html = '<div class="col-'.$this->mColLeft.'"></div><div class="col-'.$this->mColRight.'">'.$html.'</div>';

		return $html;
	}

	// Form group with Submit button
	public function form_group_submit($class, $label)
	{
		$btn = '<button type="submit" class="'.$class.'">'.$label.'</button>';

		if ($this->mType=='horizontal')
		{
			$col_left = str_replace('-', '-offset-', $this->mColLeft);
			$btn = '<div class="col-'.$col_left.' col-'.$this->mColRight.'">'.$btn.'</div>';
		}

		return '<div class="form-group">'.$btn.'</div>';
	}

	// Run validation on the form and return result
	public function validate()
	{
		$CI =& get_instance();

		// reCAPTCHA verification (skipped in development mode)
		if ( $this->mRecaptchaAdded && ENVIRONMENT!='development' )
		{
			$CI->load->config('form_validation');
			$secret_key = $CI->config->item('recaptcha')['secret_key'];
			$recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
			$resp = $recaptcha->verify($CI->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

			if (!$resp->isSuccess())
			{
				// failed
				//$errors = $resp->getErrorCodes();
				$this->mErrorMsg['custom'][] = 'ReCAPTCHA failed.';
				return FALSE;
			}
		}

		// check with CodeIgniter validation
		$result = $CI->form_validation->run($this->mRuleSet);
		if ($result===FALSE)
		{
			// store validation error message from CodeIgniter
			$this->mErrorMsg['validation'] = validation_errors();
		}

		return $result;
	}

	// Append non-validation error message
	// TODO: option to save error message to flash data (e.g. when need to redirect page on failure)
	public function add_custom_error($msg, $flash = FALSE)
	{
		$this->mErrorMsg['custom'][] = $msg;
	}

	// Display error messages (validation & custom error)
	public function render_error()
	{
		$msg = $this->mErrorMsg['validation'];

		if (sizeof($this->mErrorMsg['custom'])>0)
		{
			$msg.= empty($msg) ? '' : '<br/>';
			$msg.= implode('<br/>', $this->mErrorMsg['custom']);
		}

		return render_alert('danger', $msg);
	}
}