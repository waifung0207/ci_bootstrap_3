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

	protected $CI;

	protected $mPostUrl;		// target POST URL
	protected $mFormUrl;		// URL to display form (default: same as $mPostUrl)
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

	// content from flashdata (e.g. error message, success message, form fields)
	protected $mFlashDataName;
	protected $mFlashMsg = array();
	protected $mFlashFields = array();

	// temporary store messages
	protected $mSuccessMsg = '';
	protected $mErrorMsg = array();

	// Constructor
	public function __construct($url, $inline_error, $multipart)
	{
		$this->CI =& get_instance();
		$this->mPostUrl = $url;
		$this->mFormUrl = $url;
		$this->mInlineError = $inline_error;
		$this->mMultipart = $multipart;

		// compose a name to avoid naming conflict from flashdata
		$this->mFlashDataName = 'form_'.$url;

		// retrieve from flashdata (if exists)
		$flash = ( $this->CI->session->has_userdata($this->mFlashDataName) ) ? $this->CI->session->flashdata($this->mFlashDataName) : array();

		// store messages from flashdata
		$this->mFlashMsg = array(
			'error'		=> empty($flash['error']) ? '' : $flash['error'],
			'success'	=> empty($flash['success']) ? '' : $flash['success'],
		);

		// store field values from flashdata
		$this->mFlashFields = empty($flash['fields']) ? '' : $flash['fields'];
	}

	// Change URL where the form is displayed
	public function set_form_url($url)
	{
		$this->mFormUrl = $url;
	}

	// Update rule set (default: same as $mPostUrl)
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
	
	// Store success message
	public function set_success_msg($msg)
	{
		$this->mSuccessMsg = $msg;
	}

	// Append error message
	public function add_error_msg($msg)
	{
		$this->mErrorMsg[] = $msg;
	}

	// Append an text field
	public function add_text($name, $label = '', $placeholder = NULL, $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && ($placeholder===NULL) )
			$placeholder = $label;

		// set field values
		if ( !empty($this->mFlashFields[$name]) )
			$value = $this->mFlashFields[$name];
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

	// Form group with control, label and error field
	public function form_group($name, $control, $label = '')
	{
		$error = form_error($name, '<p class="text-danger">', '</p>');
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
		$this->CI->load->config('form_validation');
		$site_key = $this->CI->config->item('recaptcha')['site_key'];

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
		$flash = array();

		// reCAPTCHA verification (skipped in development mode)
		if ( $this->mRecaptchaAdded && ENVIRONMENT!='development' )
		{
			$this->CI->load->config('form_validation');
			$secret_key = $this->CI->config->item('recaptcha')['secret_key'];
			$recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
			$resp = $recaptcha->verify($this->CI->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

			if (!$resp->isSuccess())
			{
				// failed
				//$errors = $resp->getErrorCodes();
				$this->add_error_msg('ReCAPTCHA failed.');
				$flash['error'] = $this->mErrorMsg;
				$this->CI->session->set_flashdata($this->mFlashDataName, $flash);

				// directly display form again (interrupt other operations)
				redirect($this->mFormUrl);
			}
		}

		// check with CodeIgniter validation
		$result = $this->CI->form_validation->run($this->mRuleSet);
		if ($result===FALSE)
		{
			// save field values to flashdata
			foreach ($this->mFields as $field)
			{
				// filter specific field types
				switch ($field['type'])
				{
					case 'text':
					case 'email':
					case 'textarea':
						$name = $field['name'];
						$flash['fields'][$name] = $this->CI->input->post($name);
						break;
				}
			}

			// store validation error message from CodeIgniter
			$this->add_error_msg(validation_errors());
			$flash['error'] = $this->mErrorMsg;
			$this->CI->session->set_flashdata($this->mFlashDataName, $flash);

			// directly display form again (interrupt other operations)
			redirect($this->mFormUrl);
		}
		else
		{
			// save success message to flashdata
			$flash['success'] = $this->mSuccessMsg;
			$this->CI->session->set_flashdata($this->mFlashDataName, $flash);

			// other logic to be done outside (e.g. update database > then redirect page)
		}

		return $result;
	}

	// Save selected fields to flashdata
	public function save_field_to_flash($name)
	{
		$flash = array();
		
		if ( $this->CI->session->has_userdata($this->mFlashDataName) )
		{
			$flash = $this->CI->session->flashdata($this->mFlashDataName);
			$this->CI->session->keep_flashdata($this->mFlashDataName);
		}

		$flash['fields'][$name] = $this->CI->input->post($name);
		$this->CI->session->set_flashdata($this->mFlashDataName, $flash);
	}

	// Render a complete form
	public function render()
	{
		if ($this->mMultipart)
			$str = form_open_multipart($this->mPostUrl, $this->mAttributes);
		else
			$str = form_open($this->mPostUrl, $this->mAttributes);

		// print out all fields
		foreach ($this->mFields as $field)
		{
			$str .= $this->render_field($field);
		}

		$str .= $this->mFooterHtml;
		$str .= form_close();
		return $str;
	}

	// Display messages (success / validation error / other error) in following priority:
	// 	1. Message from get_alert() - see application/helpers/session_helper.php
	// 	2. Error message from flashdata
	// 	3. Success message from flashdata
	// 	Render empty string when none of above exists
	public function render_msg()
	{
		$alert = get_alert();

		if ( !empty($alert) )
		{
			$type = $alert['type'];
			$msg = $alert['msg'];
		}
		else if ( !empty($this->mFlashMsg['error']) )
		{
			$type = 'danger';
			$msg = implode('<br/>', $this->mFlashMsg['error']);
		}
		else if ( !empty($this->mFlashMsg['success']) )
		{
			$type = 'success';
			$msg = $this->mFlashMsg['success'];
		}
		else
		{
			return '';
		}

		return render_alert($type, $msg);
	}
}