<?php

# secure area class. controllers that are secure should extend this class
class Secure_area extends Controller 
{
	function __construct($module_id=null) # module ID can be set to restrict access to certain users to certain modules
	{
		parent::__construct();	
		$this->load->model('Employee');
		if(!$this->Employee->is_logged_in())
		{
			redirect('login');
		}
		
		if(!$this->Employee->has_permission($module_id,$this->Employee->get_logged_in_employee_info()->person_id))
		{
			redirect('no_access/'.$module_id);
		}
		
		# global data
		$logged_in_employee_info=$this->Employee->get_logged_in_employee_info();
		$data['allowed_modules']=$this->Module->get_allowed_modules($logged_in_employee_info->person_id);
		$data['user_info']=$logged_in_employee_info;
		$this->load->vars($data);
	}
}
?>