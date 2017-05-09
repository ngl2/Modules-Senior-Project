<?php

# report class
abstract class Report extends Model 
{
	function __construct()
	{
		parent::Model();

		# ensure browser doesn't have a cache of the report to promote data integrity and precise figures
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		$this->output->set_header("Pragma: no-cache");
		
		# create a temporary table to hold our report outcome
		$this->Sale->create_sales_items_temp_table();
	}
	
	# return report column names
	public abstract function getDataColumns();
	
	# return all report data to fill table
	public abstract function getData(array $inputs);
	
	// return a key=>value pair of summary data for the report
	public abstract function getSummaryData(array $inputs);
}
?>