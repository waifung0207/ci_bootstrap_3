<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Swagger Definitions
|--------------------------------------------------------------------------
| Example: https://github.com/zircote/swagger-php/tree/master/Examples/petstore.swagger.io/models
*/

// To avoid class naming conflicts when defining Swagger Definitions
namespace MySwaggerDefinitions;

/**
 * @SWG\Definition()
 */
class Demo {

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
	public $name;
}
/**
 * @SWG\Definition()
 */
class DemoUser {

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
	public $email;

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

/**
 * @SWG\Definition()
 */
class DemoUserPut {

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
}

/**
 * @SWG\Definition()
 */
class DemoSignUp {
	
	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $email;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $password;

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
}

/**
 * @SWG\Definition()
 */
class DemoActivate {

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $id;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $code;
}

/**
 * @SWG\Definition()
 */
class DemoLogin {

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $email;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $password;
}

/**
 * @SWG\Definition()
 */
class DemoForgotPassword {

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $email;
}

/**
 * @SWG\Definition()
 */
class DemoResetPassword {

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $code;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $password;

	/**
	 * @var string
	 * @SWG\Property()
	 */
	public $password_confirm;
}