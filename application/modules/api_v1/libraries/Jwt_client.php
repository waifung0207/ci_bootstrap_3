<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to handle JSON Web Tokens (JWT) operations
 */
class Jwt_client {

	// Security key to encode / decode JWT
	private $mKey = "example_key";

	// encode to a JWT with expiry
	public function encode($data, $expiry = 600)
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
			"iss" => "CI Bootstrap 3",
			"iat" => $curr_time,
			"exp" => $curr_time + $expiry,
			"jti" => random_string('unique')
		);

		// append data to store with token
		$token = array_merge($token, $data);

		// encode and return string
		return JWT::encode($token, $this->mKey);
	}

	// decode token
	public function decode($jwt)
	{
		$decoded = JWT::decode($jwt, $this->mKey, array('HS256'));
		return (array)$decoded;
	}
}