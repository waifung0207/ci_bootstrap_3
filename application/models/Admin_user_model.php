<?php 

class Admin_user_model extends MY_Model {

	/**
	 * Authentication
	 */
	public function login($username, $password)
	{
		// only activated user can login
		$where = array('username' => $username, 'active' => 1);
		$user = $this->get_by($where);
		
		if ( !empty($user) && password_verify($password, $user->password) )
		{
			// success - return user object without password field
			unset($user->password);
			return $user;
		}

		// failed
		return NULL;
	}
}