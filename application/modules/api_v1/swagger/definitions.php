<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Swagger Definitions
|--------------------------------------------------------------------------
| Example: https://github.com/zircote/swagger-php/tree/master/Examples/petstore.swagger.io/models
*/

// To avoid class naming conflicts when defining Swagger Definitions
namespace MySwagger;

/**
 * @SWG\Definition()
 */
class User {

	/**
	 * Unique ID
	 * @var int
	 * @SWG\Property()
	 */
	public $id;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $first_name;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $last_name;

	/**
	 * @var string
	 * @SWG\Property(enum={"pending", "blacklisted"})
	 */
	public $status;
}