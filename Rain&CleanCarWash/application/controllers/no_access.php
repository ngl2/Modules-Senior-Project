<?php

# no access class used across the project to deny direct script access
class No_Access extends Controller 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index($module_id='')
	{
		$data['module_name']=$this->Module->get_module_name($module_id);
		$this->load->view('no_access',$data);
	}
}
?>