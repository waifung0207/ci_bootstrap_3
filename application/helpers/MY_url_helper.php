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

// refresh current page (interrupt other actions)
function refresh()
{
	redirect(current_url(), 'refresh');
}