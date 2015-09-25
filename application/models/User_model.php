<?php 

class User_model extends MY_Model {

	protected $mConfig;

	public function __construct()
	{
		parent::__construct();
		
		// load config file
		$this->load->config('site');
		$site_config = $this->config->item('site');
		$this->mConfig = $site_config['auth'];
	}
	
	/**
	 * Create user account
	 */
	public function sign_up($login, $password, $additional_fields)
	{
		$login_field = $this->mConfig['login_field'];
		$require_activation = $this->mConfig['activation']['enabled'];

		// check existing record to avoid duplicated user
		$user = $this->get_by($login_field, $login);

		if ( empty($user) )
		{
			// create user record
			$status = $require_activation ? 'pending' : 'active';
			$user = array(
				$login_field	=> $login,
				'password'		=> password_hash($password, PASSWORD_DEFAULT),
				'status'		=> $status,
			);
			$user = array_merge($user, $additional_fields);
			$user_id = $this->insert($user);
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
			$this->update($user->id, array('activation_code' => $code));

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
		$where = array('activation_code' => $code, 'status' => 'pending');
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
				'status'			=> 'active',
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
		$where = array($login_field => $login, 'status' => 'active');
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
		// TODO: complete function or use third-party libraries
	}

	/**
	 * Forgot Password
	 */
	public function forgot_password($login)
	{
		// only activated user can proceed
		$login_field = $this->mConfig['login_field'];
		$where = array($login_field => $login, 'status' => 'active');
		$user = $this->get_by($where);

		if ( !empty($user) )
		{
			// proceed to send Reset Password email
			$this->load->helper('string');
			$this->load->helper('email');

			// random unique code
			$code = random_string('unique');
			$this->update($user->id, array('forgot_password_code' => $code));

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
			$this->update($user->id, array('forgot_password_code' => NULL));
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
		return $this->update($user_id, array('password' => $hashed));
	}
}