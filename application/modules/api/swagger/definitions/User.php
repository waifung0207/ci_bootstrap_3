<?php
defined('BASEPATH') OR exit('No direct script access allowed');

namespace MySwaggerDefinitions;

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