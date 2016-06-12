<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//For view all the languages go to the folder assets/grocery_crud/languages/
	$config['grocery_crud_default_language']	= 'english';

	// There are only three choices: "uk-date" (dd/mm/yyyy), "us-date" (mm/dd/yyyy) or "sql-date" (yyyy-mm-dd)
	$config['grocery_crud_date_format']			= 'sql-date';

	// The default per page when a user firstly see a list page
	$config['grocery_crud_default_per_page']	= 10;

	$config['grocery_crud_file_upload_allow_file_types'] 		= 'gif|jpeg|jpg|png|tiff|doc|docx|txt|odt|xls|xlsx|pdf|ppt|pptx|pps|ppsx|mp3|m4a|ogg|wav|mp4|m4v|mov|wmv|flv|avi|mpg|ogv|3gp|3g2';
	$config['grocery_crud_file_upload_max_file_size'] 			= '20MB'; //ex. '10MB' (Mega Bytes), '1067KB' (Kilo Bytes), '5000B' (Bytes)

	//You can choose 'ckeditor4', 'ckeditor', 'summernote', 'trumbowyg', 'tinymce' or 'markitup'
	$config['grocery_crud_default_text_editor'] = 'ckeditor';
	//You can choose 'minimal' or 'full' (only effective for 'ckeditor')
	$config['grocery_crud_text_editor_type'] 	= 'full';

	//The character limiter at the list page, zero(0) value if you don't want character limiter at your list page
	$config['grocery_crud_character_limiter'] 	= 30;

	//All the forms are opening with dialog forms without refreshing the page once again.
	//IMPORTANT: PLease be aware that this functionality is still in BETA phase and it is 
	//not suggested to use this in production mode
	$config['grocery_crud_dialog_forms'] = false;

	//Having some options at the list paging. This is the default one that all the websites are using.
	//Make sure that the number of grocery_crud_default_per_page variable is included to this array.
	$config['grocery_crud_paging_options'] = array('10','25','50','100');

	//Default theme for grocery CRUD
	$config['grocery_crud_default_theme'] = 'flexigrid';

	//The environment is important so we can have specific configurations for specific environments
	$config['grocery_crud_environment'] = 'production';

	/**
	 * Added by CI Bootstrap 3
	 */
	$config['grocery_crud_unset_jquery'] = TRUE;
	$config['grocery_crud_unset_jquery_ui'] = FALSE;
	$config['grocery_crud_unset_print'] = FALSE;
	$config['grocery_crud_unset_export'] = FALSE;
	$config['grocery_crud_unset_read'] = FALSE;
	
	// common fields to unset from CRUD
	$config['grocery_crud_unset_fields'] = array(
		// fields from Ion Auth
		'password', 'salt', 'activation_code', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on',
		
		// general fields to hide from CRUD
		'pos', 'created_at', 'updated_at', 'activated_at',
	);
	
	// common fields to "display as"
	$config['grocery_crud_display_as'] = array(
		'group_id'				=> 'Group',
		'image_url'				=> 'Image',
		'thumbnail_url'			=> 'Thumbnail',

		'author_id'				=> 'Author',
		'category_id'			=> 'Category',
	);
