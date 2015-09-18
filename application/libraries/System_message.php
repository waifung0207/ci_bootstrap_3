<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to set / get system messages
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
	public function set($type, $msg, $save_to = 'flash')
	{
		$this->mMessages[$type] = array($msg);
		$this->save($save_to);
	}

	// Append message of specific type
	public function add($type, $msg, $save_to = 'flash')
	{
		$this->mMessages[$type][] = $msg;
		$this->save($save_to);
	}
	
	// Set a success message (clear other success messages)
	public function set_success($msg, $save_to = 'flash')
	{
		$this->set('success', $msg);
	}

	// Append success message
	public function add_success($msg, $save_to = 'flash')
	{
		$this->add('success', $msg);
	}

	// Set an error message (clear other error messages)
	public function set_error($msg, $save_to = 'flash')
	{
		$this->set('error', $msg);
	}

	// Append error message
	public function add_error($msg, $save_to = 'flash')
	{
		$this->add('error', $msg);
	}

	// Save messages to Flashdata
	public function save($to = 'flash')
	{
		switch ($to)
		{
			case 'flash':
				$this->CI->session->set_flashdata($this->mSessionKey, $this->mMessages);
				break;
			case 'session':
				$this->CI->session->set_userdata($this->mSessionKey, $this->mMessages);
				break;
			case 'temp':
				$this->CI->session->set_tempdata($this->mSessionKey, $this->mMessages);
				break;
		}
	}

	// Restore message from Flashdata
	public function restore($from = 'flash', $keep_flash = FALSE)
	{
		switch ($from)
		{
			case 'flash':
				$this->mMessages = $this->CI->session->flashdata($this->mSessionKey);

				// keep flashdata for longer time
				if ($keep_flash)
				{
					$this->CI->session->keep_flashdata($this->mSessionKey);
				}
				break;
			case 'session':
				$this->mMessages = $this->CI->session->userdata($this->mSessionKey);
				break;
			case 'temp':
				$this->mMessages = $this->CI->session->tempdata($this->mSessionKey);
				break;
		}
	}

	// Render all system messages
	public function render($from = 'flash')
	{
		$this->restore($from);
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