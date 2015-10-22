<?php

/**
 * Helper class with shortcut functions to lookup URL
 */

// location of public asset folder
function asset_url($path)
{
	return base_url('assets/'.$path);
}

// location of uploaded files
function upload_url($path)
{
	return base_url('assets/uploads/'.$path);
}

// location of post-processed assets (e.g. combined CSS / JS files)
function dist_url($path)
{
	return base_url('assets/dist/'.$path);
}

// location of post-processed images (i.e. optimized filesize)
function image_url($path)
{
	return base_url('assets/dist/images/'.$path);	
}

// current URL includes query string
// Reference: http://stackoverflow.com/questions/4160377/codeigniter-current-url-doesnt-show-query-strings
function current_full_url()
{
	$CI =& get_instance();
	$url = $CI->config->site_url($CI->uri->uri_string());
	return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

// refresh current page (interrupt other actions)
function refresh()
{
	redirect(current_full_url(), 'refresh');
}

// referrer page
function referrer()
{
	$CI =& get_instance();
	$CI->load->library('user_agent');
	return $CI->agent->referrer();
}

// redirect back to referrer page
function redirect_referrer()
{
	redirect(referrer());
}