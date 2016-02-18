<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| JWT Config
| -------------------------------------------------------------------------
| Values to be used in Jwt Client library
|
*/

$config['jwt_secret_key'] = 'example_key';

$config['jwt_issuer'] = 'CI Bootstrap 3';

// expiry time since a JWT is issued (in seconds); set NULL to never expired
$config['jwt_expiry'] = NULL;