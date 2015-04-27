<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Localization
| -------------------------------------------------------------------------
| This file contains localization settings for each site.
|
*/

$config['locale'] = array(

	'frontend' => array(
		'enabled'		=> TRUE,
		'available'		=> array(			// availabe languages with names to display on site (e.g. on menu)
			'en' 		=> 'English',
			'zh'		=> '繁體中文',
			'cn'		=> '简体中文',
		),
		'autoload'		=> array(),			// language files to autoload
	),

	'admin' => array(
		'enabled'		=> FALSE,
	),

);