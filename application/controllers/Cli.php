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

		echo '====== Task: Backup database'.PHP_EOL;
		$backup = $this->dbutil->backup($prefs);
		$file_path_1 = FCPATH.'sql/backup/'.date('Y-m-d_H-i-s').'.sql';
		$file_path_2 = FCPATH.'sql/latest.sql';
		write_file($file_path_1, $backup);
		write_file($file_path_2, $backup);

		echo 'Database saved to these files: '.PHP_EOL;
		echo ' - '.$file_path_1.PHP_EOL;
		echo ' - '.$file_path_2.PHP_EOL;
		echo '====== Task: Backup database (Completed)'.PHP_EOL;
	}

	// Empty all database tables except "admin_users"
	// Command: php index.php cli clean_db
	public function clean_db()
	{
		$this->load->database();

		echo '====== Task: Empty database'.PHP_EOL;
		$this->db->truncate('cover_photos');
		$this->db->truncate('blog_categories');
		$this->db->truncate('blog_tags');
		$this->db->truncate('blog_post_tag_rel');
		$this->db->truncate('blog_posts');
		echo '====== Task: Empty database (Completed)'.PHP_EOL;
	}

	// Backup only the default tables (from CI Bootstrap)
	public function save_default_db()
	{
		$this->load->dbutil();
		$this->load->helper('file');
		$prefs = array('format' => 'txt');
		
		// Admin Users
		$prefs['tables'] = array('admin_users');
		$backup = $this->dbutil->backup($prefs);
		$file_path = FCPATH.'sql/core/admin_users.sql';
		write_file($file_path, $backup);
		echo 'Database saved to: '.$file_path.PHP_EOL;
		
		// Frontend Users
		$prefs['tables'] = array('users');
		$backup = $this->dbutil->backup($prefs);
		$file_path = FCPATH.'sql/core/users.sql';
		write_file($file_path, $backup);
		echo 'Database saved to: '.$file_path.PHP_EOL;

		// Cover Photos
		$prefs['tables'] = array('cover_photos');
		$backup = $this->dbutil->backup($prefs);
		$file_path = FCPATH.'sql/core/cover_photos.sql';
		write_file($file_path, $backup);
		echo 'Database saved to: '.$file_path.PHP_EOL;

		// Blog
		$prefs['tables'] = array('blog_posts', 'blog_categories', 'blog_tags', 'blog_post_tag_rel');
		$backup = $this->dbutil->backup($prefs);
		$file_path = FCPATH.'sql/core/blog.sql';
		write_file($file_path, $backup);
		echo 'Database saved to: '.$file_path.PHP_EOL;
	}
	
	// Reset database to default (i.e. from /sql/latest.sql)
	// Command: php index.php cli reset_db
	public function reset_db()
	{
		echo '====== Task: Reset database'.PHP_EOL;
		echo 'To be implemented'.PHP_EOL;
	}

	// Migrate database
	// Command: php index.php cli migrate
	public function migrate()
	{
		echo '====== Task: Migrate database'.PHP_EOL;
		echo 'To be implemented'.PHP_EOL;
	}
}