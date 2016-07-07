<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util extends Admin_Controller {

	private $mLatestSqlFile;
	private $mBackupSqlFiles;

	public function __construct()
	{
		parent::__construct();

		// list out .sql files from /sql/backup/ folder
		$sql_path = FCPATH.'sql';
		$files = preg_grep("/.(.sql)$/", scandir($sql_path.'/backup', SCANDIR_SORT_DESCENDING));
		$this->mBackupSqlFiles = $files;
		$this->mLatestSqlFile = $sql_path.'/latest.sql';

		$this->mPageTitle = 'Utilities';
		$this->mViewData['backup_sql_files'] = $this->mBackupSqlFiles;
		$this->mViewData['latest_sql_file'] = $this->mLatestSqlFile;
	}

	// List out saved versions of database
	public function list_db()
	{
		$this->render('util/list_db');
	}

	// Backup current database version
	public function backup_db()
	{
		$this->load->dbutil();
		$this->load->helper('file');

		// Options: http://www.codeigniter.com/user_guide/database/utilities.html?highlight=csv#setting-backup-preferences
		$prefs = array('format' => 'txt');
		$backup = $this->dbutil->backup($prefs);
		$file_path_1 = FCPATH.'sql/backup/'.date('Y-m-d_H-i-s').'.sql';
		$result_1 = write_file($file_path_1, $backup);
		
		// overwrite latest.sql
		$save_latest = $this->input->get('save_latest');
		if ( !empty($save_latest) )
		{
			$file_path_2 = FCPATH.'sql/latest.sql';
			$result_2 = write_file($file_path_2, $backup);	
		}

		redirect($this->mModule.'/util/list_db');
	}

	// Restore specific version of database
	public function restore_db($file)
	{
		$path = '';
		if ($file=='latest')
			$path = FCPATH.'sql/latest.sql';
		else if ( in_array($file, $this->mBackupSqlFiles) )
			$path = FCPATH.'sql/backup/'.$file;

		// proceed to execute SQL queries
		if ( !empty($path) && file_exists($path) )
		{
			//$sql = file_get_contents($path);
			//$this->db->query($sql);
			$username = $this->db->username;
			$password = $this->db->password;
			$database = $this->db->database;
			exec("mysql -u $username -p$password --database $database < $path");
		}

		redirect($this->mModule.'/util/list_db');
	}

	// Remove specific database version
	public function remove_db($file)
	{
		if ( in_array($file, $this->mBackupSqlFiles) )
		{
			$path = FCPATH.'sql/backup/'.$file;

			$this->load->helper('file');
			unlink($path);
			$result = delete_files($path);
		}

		redirect($this->mModule.'/util/list_db');
	}
}
