<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to import data from .csv files
 */
class Data_importer {

	/**
	 * Import data from .csv file to a single table.
	 * Reference: http://csv.thephpleague.com/
	 * 
	 * Sample usage:
	 * 	$fields = array('name', 'email', 'age', 'active');
	 *  $this->load->library('data_importer');
	 *  $this->data_importer->csv_import('data.csv', 'users', $fields, TRUE);
	 */
	public function csv_import($file, $table, $fields, $clear_table = FALSE, $delimiter = ',', $skip_header = TRUE)
	{
		$CI =& get_instance();
		$CI->load->database();

		// prepend file path with project directory
		$reader = League\Csv\Reader::createFromPath(FCPATH.$file);
		$reader->setDelimiter($delimiter);

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

	/**
	 * Import data from Excel file to a single table.
	 * Reference: https://phpexcel.codeplex.com/
	 *
	 * TODO: complete feature
	 */
	public function excel_import($file, $table)
	{
		// prepend file path with project directory
		$excel = PHPExcel_IOFactory::load(FCPATH.$file);

		foreach ($excel->getWorksheetIterator() as $worksheet)
		{
			// to be completed
		}
	}
}