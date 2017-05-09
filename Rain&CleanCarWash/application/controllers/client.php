<?php 

# client class
class Client extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['form_width']=$this->get_form_width();
		$data['client_items']=client_items_manage_table($this->Item->get_all(),$this);
		$this->load->view('client',$data);
	}

	
	# get the width for the add/edit form
	function get_form_width()
	{
		return 360;
	}
}
?>