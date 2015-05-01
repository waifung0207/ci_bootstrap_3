<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Localization
| -------------------------------------------------------------------------
| This file contains localization settings for each site.
|
*/

$config['site_languages'] = array(

	'frontend' => array(
		'enabled'		=> TRUE,
		'default'		=> 'en',			// to decide which of the "available" languages should be used
		'available'		=> array(			// availabe languages with names to display on site (e.g. on menu)
			'en' => array(					// abbr. value to be used on URL, or linked with database fields
				'label'	=> 'English',		// label to be displayed on language switcher
				'value'	=> 'english',		// to match with CodeIgniter folders inside application/language/
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'chinese_traditional',
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'chinese_simplified',
			),
		),
		'autoload'		=> array('general'),			// language files to autoload
	),

	'admin' => array(
		'enabled'		=> FALSE,
		'default'		=> 'en',
	),

);