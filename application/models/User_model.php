<?php 

class User_model extends MY_Model {

	protected $mConfig;

	public function __construct()
	{
		parent::__construct();
		$this->load->config('auth');
		$this->mConfig = $this->config->item('auth')['frontend'];
	}

	/**
	 * Override parent
	 */
	public function get_by($where, $joins = array())
	{
		$this->set_table_alias('u');
		$this->db->select('u.id, u.email, u.password, u.first_name, u.last_name, u.active, ug.name AS group');
		$joins[] = array('user_groups AS ug', 'u.group_id = ug.id');
		return parent::get_by($where, $joins);
	}

	/**
	 * Create user account
	 */
	public function sign_up($login, $password, $additional_fields)
	{
		$login_field = $this->mConfig['login_field'];
		$require_activation = $this->mConfig['activation']['enabled'];

		// check existing record to avoid duplicated user
		$user = $this->get_by(array($login_field => $login));

		if ( empty($user) )
		{
			// create user record
			$user = array(
				$login_field	=> $login,
				'password'		=> password_hash($password, PASSWORD_DEFAULT),
				'active'		=> !$require_activation,
			);
			$user = array_merge($user, $additional_fields);
			$user_id = $this->create($user);
			$user = (object)$user;
			$user->id = $user_id;
		}

		// request user to activate account
		if ($require_activation)
		{
			$this->load->helper('string');
			$this->load->helper('email');

			// random unique code
			$code = random_string('unique');
			$this->update_field($user->id, 'activation_code', $code);

			// send activation email to user
			$to_email = ($login_field=='email') ? $login : $additional_fields['email'];
			$view = $this->mConfig['activation']['email'];
			$subject = $this->mConfig['activation']['email_subject'];
			$url = $this->mConfig['activation']['url'];
			$email_data = array('code' => $code, 'url' => $url);
			send_email($to_email, 'User', $subject, $view, $email_data);
		}

		return $user;
	}

	/**
	 * Activate user account
	 */
	public function activate($code)
	{
		$where = array('activation_code' => $code, 'active' => 0);
		$user = $this->get_by($where);

		if ( empty($user) )
		{
			// invalid code or user already activated
			return FALSE;
		}
		else
		{
			// proceed to activate user
			$data = array(
				'activation_code'	=> NULL,
				'activated_at'		=> date('Y-m-d H:i:s'),
				'active'			=> 1,
			);
			return $this->update($user->id, $data);
		}
	}

	/**
	 * Login (by email / username + password)
	 */
	public function login($login, $password)
	{
		// only activated user can proceed
		$login_field = $this->mConfig['login_field'];
		$where = array($login_field => $login, 'active' => 1);
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

	/**
	 * Login (by social network)
	 */
	public function login_social($platform = 'facebook')
	{
		// to be completed
	}

	/**
	 * Forgot Password
	 */
	public function forgot_password($login)
	{
		// only activated user can proceed
		$login_field = $this->mConfig['login_field'];
		$where = array($login_field => $login, 'active' => 1);
		$user = $this->get_by($where);

		if ( !empty($user) )
		{
			// proceed to send Reset Password email
			$this->load->helper('string');
			$this->load->helper('email');

			// random unique code
			$code = random_string('unique');
			$this->update_field($user->id, 'forgot_password_code', $code);

			// send Forgot Password email to user
			$view = $this->mConfig['forgot_password']['email'];
			$subject = $this->mConfig['forgot_password']['email_subject'];
			$url = $this->mConfig['forgot_password']['url'];
			$email_data = array('code' => $code, 'url' => $url);
			send_email($user->email, 'User', $subject, $view, $email_data);

			return TRUE;
		}

		// invalid user
		return FALSE;
	}

	// check whether a Forgot Password code is valid
	public function verify_forgot_password_code($code)
	{
		if ( empty($code) )
			return FALSE;
		else
			return $this->users->exists(array('forgot_password_code' => $code));
	}

	/**
	 * Reset Password
	 */
	public function reset_password($code, $password)
	{
		$where = array('forgot_password_code' => $code);
		$user = $this->get_by($where);

		if ( !empty($user) )
		{
			// proceed to change user password
			$this->update_field($user->id, 'forgot_password_code', NULL);
			return $this->change_password($user->id, $password);
		}

		// invalid code
		return NULL;
	}

	/**
	 * Update account info
	 */
	public function update_info($user_id, $data)
	{
		$data = elements(array('email', 'first_name', 'last_name'), $data);
		return $this->update($user_id, $data);
	}

	/**
	 * Change password
	 */
	public function change_password($user_id, $password)
	{
		$hashed = password_hash($password, PASSWORD_DEFAULT);
		return $this->update_field($user_id, 'password', $hashed);
	}
}