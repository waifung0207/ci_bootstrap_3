<?php

/**
 * Controller to be called from CLI only
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
			show_404();
		}
	}
	
	// Run daily cron job
	// Command: php index.php cli daily
	public function daily()
	{
		echo 'Starting daily cron job'.PHP_EOL;
		$this->backup_db();
		echo 'End of daily cron job.'.PHP_EOL;
	}

	// Run backup operation of database
	// Command: php index.php cli backup_db
	public function backup_db()
	{
		$this->load->dbutil();
		$this->load->helper('file');

		// Options: http://www.codeigniter.com/user_guide/database/utilities.html?highlight=csv#setting-backup-preferences
		$prefs = array('format' => 'txt');

		echo '=========================================================='.PHP_EOL;
		echo 'Task: Backup database'.PHP_EOL;
		$backup = $this->dbutil->backup($prefs);
		$file_path_1 = FCPATH.'sql/backup/'.date('Y-m-d_H-i-s').'.sql';
		$file_path_2 = FCPATH.'sql/latest.sql';
		write_file($file_path_1, $backup);
		write_file($file_path_2, $backup);

		echo 'Database saved to these files: '.PHP_EOL;
		echo ' - '.$file_path_1.PHP_EOL;
		echo ' - '.$file_path_2.PHP_EOL;
		echo '=========================================================='.PHP_EOL;
	}

	// Migrate database
	// Command: php index.php cli migrate
	public function migrate()
	{
		echo 'To be implemented'.PHP_EOL;
	}
}