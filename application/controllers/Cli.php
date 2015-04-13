<?php

/**
 * Controller to be called from CLI
 * Reference: http://www.codeigniter.com/user_guide/general/cli.html
 */
class Cli extends CI_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// allow execution from CLI only
		if (!is_cli())
		{
			exit('Permission denied');
		}
	}

	// Run backup operation of database
	// Example: php index.php cli backup_db
	public function backup_db()
	{
		echo 'Task: Backup database'.PHP_EOL;
		echo 'To be implemented'.PHP_EOL;
	}
	
	// Run daily cron job
	// Example: php index.php cli daily
	public function daily()
	{
		echo 'Execute daily cron job...'.PHP_EOL;
		$this->backup_db();
		echo 'Completed'.PHP_EOL;
	}
}