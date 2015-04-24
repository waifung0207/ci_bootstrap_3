<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to build form efficiently with following features:
 * 	- render form with Bootstrap theme (support Vertical form only at this moment)
 * 	- reduce effort to repeated create labels, setting placeholder, etc. with flexibility
 * 	- shortcut functions to append form elements (currently support: text, password, textarea, submit)
 *
 * To be implemented
 * 	- help with form validation and provide inline error to each field
 * 	- automatically restore "value" to fields when validation failed
 * 	- support more field types (checkbox, dropdown, upload, etc.)
 */
class Form_Builder {

	protected $CI;
	protected $mForms = array();

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('form_validation');
		//$this->CI->load->helper('form');
	}

	// Initialize a form and return the object
	public function create_form($url, $rule_set = '', $multipart = FALSE)
	{
		$rule_set = empty($rule_set) ? $url : $rule_set;
		$form = new Form($url, $rule_set, $multipart);
		$this->mForms[] = $form;
		return $form;
	}
}

/**
 * Class to store components appear on a form
 */
class Form {

	protected $mAction = '';
	protected $mRuleSet = '';
	protected $mMultipart = false;

	protected $mFields = array();
	protected $mFooterHtml = '';

	public function __construct($url, $rule_set, $multipart)
	{
		$this->mAction = $url;
		$this->mRuleSet = $rule_set;
		$this->mMultipart = $multipart;
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

	// return HTML string contains the form
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

	// run validation on the form and return result
	public function validate()
	{
		// to be completed
		return TRUE;
	}

}