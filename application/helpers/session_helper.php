<?php

/**
 * Helper class to work with common session data / flash data
 */

// Save to flashdata
function set_alert($type, $msg)
{
	$CI =& get_instance();
	$CI->session->set_flashdata('alert_type', $type);
	$CI->session->set_flashdata('alert_msg', $msg);
}

// Get from flashdata
function get_alert()
{
	$CI =& get_instance();
	$type = $CI->session->flashdata('alert_type');
	$msg = $CI->session->flashdata('alert_msg');

	if ( !empty($type) && !empty($msg) )
		return array('type' => $type, 'msg' => $msg);
	else
		return NULL;
}

// Render Alert Box
function render_alert($type = '', $msg = '')
{
	if ( empty($type) && empty($msg) )
	{
		$alert = get_alert();

		if ( empty($alert) )
			return '';

		$type = $alert['type'];
		$msg = $alert['msg'];
	}

	return empty($msg) ? '': '<div class="alert alert-'.$type.'" role="alert">'.$msg.'</div>';
}