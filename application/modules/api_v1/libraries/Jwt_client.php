<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

/**
 * Library to handle JSON Web Tokens (JWT) operations
 */
class Jwt_client {

	// Security key to encode / decode JWT
	private $mSecretKey;

	// Claim info
	private $mIssuer;
	private $mExpiry;

	// Load config from file: config/jwt.php
	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->config('jwt');

		$this->mSecretKey = $CI->config->item('jwt_secret_key');
		$this->mIssuer = $CI->config->item('jwt_issuer');
		$this->mExpiry = $CI->config->item('jwt_expiry');
	}

	// Encode to JWT
	// Append custom data via $data array, e.g. array('user_id' => 1)
	public function encode($data = array())
	{
		// References:
		// 	- http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html
		// 	- http://websec.io/2014/08/04/Securing-Requests-with-JWT.html
		// 
		// Registered Claim Names (all optional):
		// 	- iss = Issuer
		// 	- sub = Subject
		// 	- aud = Audience
		// 	- exp = Expiration Time
		// 	- nbf = Not Before
		// 	- iat = Issued At
		// 	- jti = JWT ID
		$curr_time = time();
		$token = array(
			"iss" => $this->mIssuer,
			"iat" => $curr_time,
			"jti" => random_string('unique')
		);

		// add expiry when necessary
		if ( !empty($this->mExpiry) )
			$token['exp'] = $curr_time + $this->mExpiry;

		// append data to store with token
		if ( !empty($data) )
			$token = array_merge($token, $data);
		
		// encode and return string
		return JWT::encode($token, $this->mSecretKey);
	}

	// Decode token
	// Return NULL when exception is caught
	public function decode($jwt)
	{
		try {
			$decoded = JWT::decode($jwt, $this->mSecretKey, array('HS256'));
			return (array)$decoded;	
		} catch (\Firebase\JWT\SignatureInvalidException $e) {
			// invalid JWT
			return NULL;
		} catch (\Firebase\JWT\ExpiredException $e) {
			// JWT is expired
			return NULL;
		} catch (\Firebase\JWT\BeforeValidException $e) {
			// JWT is not valid yet
			return NULL;
		} catch (Exception $e) {
			// other exceptions
			return NULL;
		}
	}
}