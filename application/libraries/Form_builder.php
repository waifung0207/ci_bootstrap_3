<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to build form efficiently with following features:
 * 	- render form with Bootstrap theme (support Vertical form only at this moment)
 * 	- reduce effort to repeated create labels, setting placeholder, etc. with flexibility
 * 	- shortcut functions to append form elements (currently support: text, password, textarea, submit)
 * 	- help with form validation and provide inline error to each field
 *
 * TODO:
 * 	- automatically restore "value" to fields when validation failed
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

	protected $mAction = '';				// target POST url
	protected $mRuleSet = '';				// name of validation rule set (match with keys inside application/config/form_validation.php)
	protected $mInlineError = TRUE;			// whether display inline error or not
	protected $mMultipart = FALSE;			// whether the form supports multipart

	protected $mFields = array();			// elements stored in the Form object with ordering
	protected $mFooterHtml = '';			// custom HTML to render after other fields

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

	// Append an text field
	public function add_text($name, $label = '', $placeholder = '', $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && empty($placeholder) )
			$placeholder = $label;

		$this->mFields[] = array(
			'type'			=> 'text',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);
	}

	// Append a password field
	public function add_password($name = 'password', $label = '', $placeholder = '', $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && empty($placeholder) )
			$placeholder = $label;

		// value is set only during development mode for security reason
		if ( ENVIRONMENT!='development' )
			$value = '';

		$this->mFields[] = array(
			'type'			=> 'password',
			'name'			=> $name,
			'label'			=> $label,
			'value'			=> $value,
			'placeholder'	=> $placeholder,
		);
	}

	// Append a textarea field
	public function add_textarea($name, $rows = 5, $label = '', $placeholder = '', $value = NULL)
	{
		// automatically set placeholder
		if ( !empty($label) && empty($placeholder) )
			$placeholder = $label;

		$this->mFields[] = array(
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

		$this->mFields[] = array(
			'type'			=> 'submit',
			'class'			=> $class,
			'label'			=> $label,
		);
	}

	// Append HTML before end of form
	public function add_footer($html)
	{
		$this->mFooterHtml .= $html;
	}

	// Return HTML string contains the form
	public function render()
	{
		if ($this->mMultipart)
			$str = form_open_multipart($this->mAction);
		else
			$str = form_open($this->mAction);

		// print out all fields
		foreach ($this->mFields as $field)
		{
			switch ($field['type'])
			{
				// Text field
				case 'text':
					$data = array(
						'id'			=> $field['name'],
						'name'			=> $field['name'],
						'value'			=> $field['value'],
						'placeholder'	=> $field['placeholder'],
						'class'			=> 'form-control',
					);

					if ($this->mInlineError)
						$str .= form_error($field['name'], '<p class="text-danger">', '</p>');

					if ( !empty($field['label']) )
						$str .= form_label($field['label'], $field['name']);

					$str .= '<div class="form-group">';
					$str .= form_input($data);
					$str .= '</div>';
					break;

				// Password field
				case 'password':
					$data = array(
						'id'			=> $field['name'],
						'name'			=> $field['name'],
						'value'			=> $field['value'],
						'placeholder'	=> $field['placeholder'],
						'class'			=> 'form-control',
					);

					if ($this->mInlineError)
						$str .= form_error($field['name'], '<p class="text-danger">', '</p>');

					if ( !empty($field['label']) )
						$str .= form_label($field['label'], $field['name']);

					$str .= '<div class="form-group">';
					$str .= form_password($data);
					$str .= '</div>';
					break;

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

					if ($this->mInlineError)
						$str .= form_error($field['name'], '<p class="text-danger">', '</p>');

					if ( !empty($field['label']) )
						$str .= form_label($field['label'], $field['name']);

					$str .= '<div class="form-group">';
					$str .= form_textarea($data);
					$str .= '</div>';
					break;

				// Upload field
				case 'upload':
					// to be completed
					break;

				// Submit button
				case 'submit':
					$str .= '<button type="submit" class="'.$field['class'].'">'.$field['label'].'</button>';
					break;
			}
		}

		$str .= $this->mFooterHtml;
		$str .= form_close();
		return $str;
	}

	// Run validation on the form and return result
	public function validate()
	{
		$CI =& get_instance();
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
		return '<div class="alert alert-danger" role="alert">
			<span class="sr-only">Error: </span>'.$msg.'</div>';
	}

}