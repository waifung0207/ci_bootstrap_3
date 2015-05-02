<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to build form efficiently with following features:
 * 	- render form with Bootstrap theme (support Vertical form only at this moment)
 * 	- reduce effort to repeated create labels, setting placeholder, etc. with flexibility
 * 	- shortcut functions to append form elements (currently support: text, password, textarea, submit)
 * 	- help with form validation and provide inline error to each field
 * 	- automatically restore "value" to fields when validation failed (using CodeIgniter set_value() function)
 * 	- Google reCAPTCHA integration
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
	public function create_form($url, $rule_set = '', $inline_error = TRUE, $multipart = FALSE)
	{
		$rule_set = empty($rule_set) ? $url : $rule_set;
		return new Form($url, $rule_set, $inline_error, $multipart);
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
	protected $mRecaptchaKeys = array();

	protected $mErrorMsg = array();			// store both validation and non-validation error messages

	public function __construct($url, $rule_set, $inline_error, $multipart)
	{
		$this->mAction = $url;
		$this->mRuleSet = $rule_set;
		$this->mInlineError = $inline_error;
		$this->mMultipart = $multipart;

		$this->mErrorMsg['validation'] = array();
		$this->mErrorMsg['custom'] = array();
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

		$this->mFields[$name] = array(
			'type'			=> 'text',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);
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

		$this->mFields[$name] = array(
			'type'			=> 'password',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);
	}

	// Append a textarea field
	public function add_textarea($name, $label = '', $placeholder = NULL, $value = NULL, $rows = 5)
	{
		// automatically set placeholder
		if ( !empty($label) && ($placeholder===NULL) )
			$placeholder = $label;

		$this->mFields[$name] = array(
			'type'			=> 'textarea',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
			'rows'			=> $rows,
		);
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

	// Append reCAPTCHA (https://www.google.com/recaptcha/)
	public function add_recaptcha($site_key, $secret_key)
	{
		$this->mRecaptchaKeys = array(
			'site'		=> $site_key,
			'secret'	=> $secret_key,
		);
		$html = '<div class="form-group g-recaptcha" data-sitekey="'.$site_key.'"></div>';

		if ($this->mType=='horizontal')
			$html = '<div class="col-'.$this->mColLeft.'"></div><div class="col-'.$this->mColRight.'">'.$html.'</div>';

		$this->add_custom_html($html);


		$this->mFields['recaptcha'] = array(
			'type'			=> 'recaptcha',
			'site_key'		=> $site_key,
			'secret_key'	=> $secret_key,
		);
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
				$value = empty($field['value']) ? set_value($field['name']) : $field['value'];
				$data = array(
					'id'			=> $field['name'],
					'name'			=> $field['name'],
					'value'			=> $value,
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
				$value = empty($field['value']) ? set_value($field['name']) : $field['value'];
				$data = array(
					'id'			=> $field['name'],
					'name'			=> $field['name'],
					'value'			=> $value,
					'placeholder'	=> $field['placeholder'],
					'rows'			=> $field['rows'],
					'class'			=> 'form-control',
				);
				$control = form_textarea($data);
				return $this->form_group($field['name'], $control, $field['label']);

			// Upload field
			case 'upload':
				// to be completed
				return '';

			// reCAPTCHA field
			case 'recaptcha':
				return $this->form_group_recaptcha($field['site_key'], $field['secret_key']);

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
	public function form_group_recaptcha($site_key, $secret_key)
	{
		$this->mRecaptchaKeys = array(
			'site'		=> $site_key,
			'secret'	=> $secret_key,
		);
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
		if ( !empty($this->mRecaptchaKeys) && ENVIRONMENT!='development' )
		{
			$recaptcha = new \ReCaptcha\ReCaptcha($this->mRecaptchaKeys['secret']);
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

	// Display non-validation error messages
	public function render_custom_error()
	{
		if ( sizeof($this->mErrorMsg['custom'])>0 )
			return $this->_render_alert( implode('<br/>', $this->mErrorMsg['custom']) );
		else
			return '';
	}

	// Display validation error messages
	public function render_validation_error()
	{
		if ( !empty($this->mErrorMsg['validation']) )
			return $this->_render_alert($this->mErrorMsg['validation']);
		else
			return '';
	}

	// Display alert box
	private function _render_alert($msg)
	{
		return '<div class="alert alert-danger" role="alert"><span class="sr-only">Error: </span>'.$msg.'</div>';
	}

}