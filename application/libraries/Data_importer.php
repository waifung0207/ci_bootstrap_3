<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Use PHP League Reader library from composer package
// Reference: http://csv.thephpleague.com/
use League\Csv\Reader;

/**
 * Library to import data from .csv files
 */
class Data_importer {

	private $mDelimiter = ',';

	public function __construct($params = NULL)
	{
		if ( !empty($params) && !empty($params['delimiter']) )
			$this->mDelimiter = $params['delimiter'];
	}

	/**
	 * Sample usage:
	 * 	$fields = array('name', 'email', 'age', 'active');
	 *  $this->load->library('data_importer');
	 *  $this->data_importer->import_to_table('data.csv', 'users', $fields, TRUE);
	 */
	public function import_to_table($file, $table, $fields, $clear_table = FALSE, $skip_header = TRUE)
	{
		$CI =& get_instance();
		$CI->load->database();

		// prepend file path with project directory
		$reader = Reader::createFromPath(FCPATH.$file);
		$reader->setDelimiter($this->mDelimiter);

		// (optional) skip header row
		if ($skip_header)
			$reader->setOffset(1);

		// prepare array to be imported
		$data = array();
		$count_fields = count($fields);
		$query_result = $reader->query();
		foreach ($query_result as $idx => $row)
		{
			// skip empty rows
			if ( !empty($row[0]) )
			{
				$temp = array();
				for ($i=0; $i<$count_fields; $i++)
				{
					$name = $fields[$i];
					$value = $row[$i];
					$temp[$name] = $value;
				}
				$data[] = $temp;
			}
		}

		// (optional) empty existing table
		if ($clear_table)
			$CI->db->truncate($table);

		// confirm import (return number of records inserted)
		return $CI->db->insert_batch($table, $data);
	}
}