<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// (Optional) Use swagger-php library
// Reference:
// 	- https://github.com/zircote/swagger-php/tree/2.x
//	- http://zircote.com/swagger-php/

/**
 * [Work-in-progress]
 * Library to generate Swagger2-compatible JSON
 * Example: http://petstore.swagger.io/v2/swagger.json
 */
class Swagger_Generator {

	// Basic info
	private $mTitle;
	private $mDescription;
	private $mVersion;
	private $mTerms = '';
	private $mContact = array();
	private $mLicense = array();
	private $mExternalDocs = array();
	private $mSchemes = array('http');

	// API data
	private $mTags = array();
	private $mDefinitions = array();
	private $mSecurityDefinitions = array();
	private $mPaths = array();

	public function init($title, $description, $version = 'v1')
	{
		$this->mTitle = $title;
		$this->mDescription = $description;
		$this->mVersion = $version;
		$this->mHost = str_replace(array('http://', 'https://'), '', site_url());
		$this->mBasePath = 'api/'.$version;
		return $this;
	}

	public function add_tag($name, $description)
	{
		$this->mTags[] = array('name' => $name, 'description' => $description);
	}

	public function add_definition($name, $fields)
	{
		$definition = array('type' => "object", 'properties' => array());
		foreach ($fields as $key => $field)
		{
			$enum = empty($field['enum']) ? NULL : $field['enum'];
			$default = empty($field['default']) ? NULL : $field['default'];
			$property = Swagger_DataType::get($field['type'], $enum, $default);
			
			if ( !empty($field['description']) )
				$property['description'] = $field['description'];

			$definition['properties'][$key] = $property;
		}
		$this->mDefinitions[$name] = $definition;
	}

	public function add_api_key($name = 'api_key')
	{
		$this->mSecurityDefinitions['api_key'] = array(
			'type' => 'apiKey',
			'name' => $name,
			'in' => 'header'
		);
	}

	public function add_path($method, $endpoint, $tags = NULL)
	{
		$path = new Swagger_Path($method, $endpoint, $tags);
		$this->mPaths[] = $path;
		return $path;
	}

	// Output finalized data
	public function get_data()
	{
		$data = array(

			// Basic info
			'swagger' => '2.0',
			'info' => array(
				'description'			=> $this->mDescription,
				'version'				=> $this->mVersion,
				'title'					=> $this->mTitle,
				'termsOfService'		=> $this->mTerms,
				'contact'				=> $this->mContact,
				'license'				=> $this->mLicense,
			),
			'host'						=> $this->mHost,
			'basePath'					=> $this->mBasePath,
			'schemes'					=> $this->mSchemes,
			'externalDocs'				=> $this->mExternalDocs,

			// API data
			'tags'						=> $this->mTags,
			'definitions'				=> $this->mDefinitions,
			'securityDefinitions'		=> $this->mSecurityDefinitions,
		);

		foreach ($this->mPaths as $path)
		{
			$data['paths'][$path->mEndpoint][$path->mMethod] = $path->render();
		}

		return $data;
	}
	public function render()
	{
		$data = $this->get_data();
		$CI =& get_instance();
		$CI->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	// Meta data
	public function add_contact($email, $name = '')
	{
		$this->mContact = array('email' => $email, 'name' => $name);
	}
	public function add_license($name, $url = '')
	{
		// e.g "Apache 2.0", "http://www.apache.org/licenses/LICENSE-2.0.html"
		$this->mLicense = array('name' => $name, 'url' => $url);
	}
	public function add_external_docs($description, $url = '')
	{
		$this->mExternalDocs = array('description' => $description, 'url' => $url);
	}
}

class Swagger_Path {

	public $mMethod;
	public $mEndpoint;
	public $mTags = array();
	public $mSummary = '';
	public $mDescription = '';
	public $mParams = array();
	public $mResponses = array();

	public function __construct($method, $endpoint, $tags)
	{
		$this->mMethod = strtolower($method);
		$this->mEndpoint = $endpoint;
		$this->mTags = is_string($tags) ? array($tags) : $tags;
	}

	// add parameter from URL path
	public function add_path_param($name, $description, $type, $required = TRUE)
	{
		$param = array(
			'name' => $name,
			'in' => 'path',
			'description' => $description,
			'required' => $required,
		);

		$param = array_merge($param, Swagger_DataType::get($type));
		$this->mParams[] = $param;
	}

	// add parameter from query string (GET parameter)
	public function add_query_param($name, $description, $type, $enum_values = NULL, $default_value = NULL, $required = FALSE)
	{
		$param = array(
			'name' => $name,
			'in' => 'query',
			'description' => $description,
			'required' => $required,
			'collectionFormat' => 'csv',
		);

		$param = array_merge($param, Swagger_DataType::get($type, $enum_values, $default_value));
		$this->mParams[] = $param;
	}

	// add parameter from POST form
	public function add_form_param($name, $description, $type, $enum_values = NULL, $default_value = NULL, $required = FALSE)
	{
		$param = array(
			'name' => $name,
			'in' => 'formData',
			'description' => $description,
			'required' => $required,
		);

		$param = array_merge($param, Swagger_DataType::get($type, $enum_values, $default_value));
		$this->mParams[] = $param;
	}

	// success response
	public function add_response($definition, $is_array = FALSE, $description = 'successful operation')
	{
		$response = array('description' => $description);

		if ($is_array)
			$response['schema'] = array('type' => 'array', 'items' => array('$ref' => '#/definitions/'.$definition));
		else
			$response['schema'] = array('$ref' => '#/definitions/'.$definition);

		$this->mResponses[200] = $response;
	}

	// error response
	public function add_error($code, $description)
	{
		$this->mResponses[$code] = array('description' => $description);
	}

	// confirm to return finalized array
	public function render()
	{
		return array(
			'tags' => $this->mTags,
			'summary' => $this->mSummary,
			'description' => $this->mDescription,

			'parameters' => $this->mParams,
			'responses' => $this->mResponses,
		);
	}
}

/**
 * Shortcut method to match with Swagger Data Types
 * Reference: http://swagger.io/specification/ (Data Types section)
 */
class Swagger_DataType {

	public static function get($key, $enum_values = NULL, $default_value = NULL)
	{
		$result = array();
		$temp = explode('|', $key);

		switch ($temp[0])
		{
			case 'INT':
				$result = array('type' => 'integer', 'format' => 'int32');
				break;
			case 'LONG':
				$result = array('type' => 'integer', 'format' => 'int64');
				break;
			case 'FLOAT':
				$result = array('type' => 'number', 'format' => 'float');
				break;
			case 'DOUBLE':
				$result = array('type' => 'number', 'format' => 'double');
				break;
			case 'STRING':
				$result = array('type' => 'string');
				break;
			case 'BYTE':
				$result = array('type' => 'string', 'format' => 'byte');
				break;
			case 'BOOLEAN':
				$result = array('type' => 'boolean');
				break;
			case 'DATE':
				$result = array('type' => 'string', 'format' => 'date');
				break;
			case 'DATETIME':
				$result = array('type' => 'string', 'format' => 'date-time');
				break;
			case 'PASSWORD':
				$result = array('type' => 'string', 'format' => 'password');
				break;
			case 'DEFINITION':
				$result = array('$ref' => '#/definitions/'.$temp[1]);
				break;
			case 'ARRAY_STRING':
				$result = array('type' => 'array', 'items' => array('type' => 'string'));
				empty($enum_values) ? NULL : $result['items']['enum'] = $enum_values;
				empty($default_value) ? NULL : $result['items']['default'] = $default_value;
				break;
			case 'ARRAY_DEFINITION':
				$result = array('type' => 'array', 'items' => array('$ref' => '#/definitions/'.$temp[1]));
				break;
			default:
				break;
		}
	
		return $result;
	}
};