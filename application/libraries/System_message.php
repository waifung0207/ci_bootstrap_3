<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to set / get system message
 */
class System_message {

	protected $CI;

	// key for storing into session / flashdata
	protected $mSessionKey = 'system_messages';

	// array to store success / error messages
	protected $mMessages;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');

		$this->mMessages = array(
			'success'	=> array(),
			'error'		=> array(),
		);
	}

	// Set a message of specific type (clear other messages)
	public function set($type, $msg)
	{
		$this->mMessages[$type] = array($msg);
	}

	// Append message of specific type
	public function add($type, $msg)
	{
		$this->mMessages[$type][] = $msg;
	}

	// Set a success message (clear other success messages)
	public function set_success($msg)
	{
		$this->set('success', $msg);
	}

	// Append success message
	public function add_success($msg)
	{
		$this->add('success', $msg);
	}

	// Set an error message (clear other error messages)
	public function set_error($msg)
	{
		$this->set('error', $msg);
	}

	// Append error message
	public function add_error($msg)
	{
		$this->add('error', $msg);
	}

	// Save messages to Flashdata
	public function save($to_flashdata = TRUE)
	{
		if ($to_flashdata)
			$this->CI->session->set_flashdata($this->mSessionKey, $this->mMessages);
		else
			$this->CI->session->set_userdata($this->mSessionKey, $this->mMessages);
	}

	// Restore message from Flashdata
	public function restore($from_flashdata = TRUE, $keep_flashdata = FALSE)
	{
		if ($from_flashdata)
			$this->mMessages = $this->CI->session->flashdata($this->mSessionKey);
		else
			$this->mMessages = $this->CI->session->userdata($this->mSessionKey);

		// keep flashdata for longer time
		if ($from_flashdata && $keep_flashdata)
			$this->CI->session->keep_flashdata($this->mSessionKey);
	}

	// Render all system messages
	public function render($from_flashdata = TRUE)
	{
		$this->restore($from_flashdata);
		return $this->render_by_type('success').$this->render_by_type('error');
	}
	
	// Render only one type of message
	public function render_by_type($type)
	{
		// for matching Bootstrap class name
		$class_names = array(
			'success'	=> 'success',
			'error'		=> 'danger',
			'warning'	=> 'warning',
		);
		$class_name = $class_names[$type];

		// compose Alert Box HTML string
		$str = '';
		if ( !empty($this->mMessages[$type]) )
		{
			$str.= "<div class='alert alert-$class_name' role='alert'>";
			foreach ($this->mMessages[$type] as $msg)
			{
				$str.= "<p>$msg</p>";
			}
			$str.= '</div>';
		}
		return $str;
	}
}