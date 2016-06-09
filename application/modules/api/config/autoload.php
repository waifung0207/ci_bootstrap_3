<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER (module-specific)
| -------------------------------------------------------------------
| For detailed usage, please check the comments from original file:
| 	/application/config/autoload.php
|
*/
$autoload['packages'] = array();

$autoload['libraries'] = array();

$autoload['drivers'] = array();

$autoload['helper'] = array();

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array(
	'api_key_model'		=> 'api_keys',
	'user_model'		=> 'users'
);
