<?php

# employee class
class Employee extends Person
{
	
	# check if $this personID exists in employee table
	function exists($person_id)
	{
		$this->db->from('employees');	
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id',$person_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}	
	
	# return all employees
	function get_all()
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');			
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	# function to retrieve info on single employee
	function get_info($employee_id)
	{
		$this->db->from('employees');	
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id',$employee_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			# load in blank parent object
			$person_obj=parent::get_info(-1);
			
			# GET all the fields from employee table
			$fields = $this->db->list_fields('employees');
			
			# return a new empty object by using the previously obtained fields
			# and appending them to the parent table
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	# info on multiple employees
	function get_multiple_info($employee_ids)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');		
		$this->db->where_in('employees.person_id',$employee_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	# create or edit employee
	function save(&$person_data, &$employee_data,&$permission_data,$employee_id=false)
	{
		$success=false;
		
		# query transaction
		$this->db->trans_start();
			
		if(parent::save($person_data,$employee_id))
		{
			if (!$employee_id or !$this->exists($employee_id))
			{
				$employee_data['person_id'] = $employee_id = $person_data['person_id'];
				$success = $this->db->insert('employees',$employee_data);
			}
			else
			{
				$this->db->where('person_id', $employee_id);
				$success = $this->db->update('employees',$employee_data);		
			}
			
			# setting employee permissions
			if($success)
			{
				# clear current permissions
				$success=$this->db->delete('permissions', array('person_id' => $employee_id));
				
				# set new permissions
				if($success)
				{
					foreach($permission_data as $allowed_module)
					{
						$success = $this->db->insert('permissions',
						array(
						'module_id'=>$allowed_module,
						'person_id'=>$employee_id));
					}
				}
			}
			
		}
		
		$this->db->trans_complete();		
		return $success;
	}
	
	# delete an employee
	function delete($employee_id)
	{
		$success=false;
		
		# don't allow deletion of currently logged in employee
		if($employee_id==$this->get_logged_in_employee_info()->person_id)
			return false;
		
		# query transaction
		$this->db->trans_start();
		
		# delete permissions
		if($this->db->delete('permissions', array('person_id' => $employee_id)))
		{
			# delete from employee table
			if($this->db->delete('employees', array('person_id' => $employee_id)))
			{
				# delete from person table
				$success = parent::delete($employee_id);
			}
		}
		$this->db->trans_complete();		
		return $success;
	}
	
	#delete list of employees
	function delete_list($employee_ids)
	{
		$success=false;
		
		# same method as before to disallow removal of logged in employee
		if(in_array($this->get_logged_in_employee_info()->person_id,$employee_ids))
			return false;

		# query transaction
		$this->db->trans_start();

		$this->db->where_in('person_id',$employee_ids);
		
		# remove permissions
		if ($this->db->delete('permissions'))
		{
			# delete from employee table
			$this->db->where_in('person_id',$employee_ids);
			if ($this->db->delete('employees'))
			{
				# delete from person table
				$success = parent::delete_list($employee_ids);
			}
		}
		$this->db->trans_complete();		
		return $success;
 	}
	
	# function to provide search suggestion when finding an employee
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');	
		$this->db->like('first_name', $search); 
		$this->db->or_like('last_name', $search);
		$this->db->or_like("CONCAT(`first_name`,' ',`last_name`)",$search);		
		$this->db->order_by("last_name", "asc");		
		$by_name = $this->db->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->first_name.' '.$row->last_name;		
		}
		
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');	
		$this->db->like("email",$search);
		$this->db->order_by("email", "asc");		
		$by_email = $this->db->get();
		foreach($by_email->result() as $row)
		{
			$suggestions[]=$row->email;		
		}
		
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');	
		$this->db->like("username",$search);
		$this->db->order_by("username", "asc");		
		$by_username = $this->db->get();
		foreach($by_username->result() as $row)
		{
			$suggestions[]=$row->username;		
		}


		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');	
		$this->db->like("phone_number",$search);
		$this->db->order_by("phone_number", "asc");		
		$by_phone = $this->db->get();
		foreach($by_phone->result() as $row)
		{
			$suggestions[]=$row->phone_number;		
		}
		
		
		# only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	
	}
	
	# search for an employee
	function search($search)
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');		
		$this->db->like('first_name', $search);
		$this->db->or_like('last_name', $search); 
		$this->db->or_like('email', $search); 
		$this->db->or_like('phone_number', $search);
		$this->db->or_like("CONCAT(`first_name`,' ',`last_name`)",$search);
		$this->db->or_like('username', $search);
		$this->db->order_by("last_name", "asc");
		
		return $this->db->get();	
	}
	
	# function to log in and create session
	function login($username, $password)
	{
		$query = $this->db->get_where('employees', array('username' => $username,'password'=>md5($password)), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			$this->session->set_userdata('person_id', $row->person_id);
			return true;
		}
		return false;
	}
	
	# function to log out and destroy session
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
	# check employee log status
	function is_logged_in()
	{
		return $this->session->userdata('person_id')!=false;
	}
	
	/*
	Gets information about the currently logged in employee.
	*/
	# return info on $this (logged in) employee
	function get_logged_in_employee_info()
	{
		if($this->is_logged_in())
		{
			return $this->get_info($this->session->userdata('person_id'));
		}
		
		return false;
	}
	
	# ensure permissions allow access to desired content
	function has_permission($module_id,$person_id)
	{
		
		# here i said if they arent missing any moduleIDs, then they must have access to all modules.
		# if any moduleID is empty, they don't have access to it.
		if($module_id==null)
		{
			return true;
		}
		
		$query = $this->db->get_where('permissions', array('person_id' => $person_id,'module_id'=>$module_id), 1);
		return $query->num_rows() == 1;
		
		
		return false;
	}

}
?>
