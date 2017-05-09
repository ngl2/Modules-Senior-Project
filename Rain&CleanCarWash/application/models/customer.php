<?php
class Customer extends Person
{	
	# find out if customer exists
	function exists($person_id)
	{
		$this->db->from('customers');	
		$this->db->join('people', 'people.person_id = customers.person_id');
		$this->db->where('customers.person_id',$person_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	
	# return all customers
	function get_all()
	{
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');			
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	# return info about customer found by customerID
	function get_info($customer_id)
	{
		$this->db->from('customers');	
		$this->db->join('people', 'people.person_id = customers.person_id');
		$this->db->where('customers.person_id',$customer_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			# load in $customerID's blank parent object (customer)
			$person_obj=parent::get_info(-1);
			
			# GET all fields in cust table
			$fields = $this->db->list_fields('customers');
			
			# return a new empty object by using the previously obtained fields
			# and appending them to the customer table
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	# get data about a selection of customers
	function get_multiple_info($customer_ids)
	{
		$this->db->from('customers');
		$this->db->join('people', 'people.person_id = customers.person_id');		
		$this->db->where_in('customers.person_id',$customer_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	# create or edit edit customer
	function save(&$person_data, &$customer_data,$customer_id=false)
	{
		$success=false;
		# query
		$this->db->trans_start(); # start a transaction to avoid partial execution
		
		if(parent::save($person_data,$customer_id))
		{
			if (!$customer_id or !$this->exists($customer_id))
			{
				$customer_data['person_id'] = $person_data['person_id'];
				$success = $this->db->insert('customers',$customer_data);				
			}
			else
			{
				$this->db->where('person_id', $customer_id);
				$success = $this->db->update('customers',$customer_data);
			}
			
		}
		
		$this->db->trans_complete();		
		return $success;
	}
	
	# delete a selected customer
	function delete($customer_id)
	{
		$success=false;
		
		# query transaction
		$this->db->trans_start();
		
		# remove from customer table
		if($this->db->delete('customers', array('person_id' => $customer_id)))
		{
			# remove from person table
			$success = parent::delete($customer_id);
		}
		
		$this->db->trans_complete();		
		return $success;
	}
	
	# function to delete a customer list
	function delete_list($customer_ids)
	{
		$success=false;

		# query transaction
		$this->db->trans_start();

		$this->db->where_in('person_id',$customer_ids);
		if ($this->db->delete('customers'))
		{
			$success = parent::delete_list($customer_ids);
		}
		
		$this->db->trans_complete();		
		return $success;
 	}
 	
	# search suggestions
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');	
		$this->db->like('first_name', $search); 
		$this->db->or_like('last_name', $search);
		$this->db->or_like("CONCAT(`first_name`,' ',`last_name`)",$search);		
		$this->db->order_by("last_name", "asc");		
		$by_name = $this->db->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->first_name.' '.$row->last_name;		
		}
		
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');	
		$this->db->like("email",$search);
		$this->db->order_by("email", "asc");		
		$by_email = $this->db->get();
		foreach($by_email->result() as $row)
		{
			$suggestions[]=$row->email;		
		}

		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');	
		$this->db->like("phone_number",$search);
		$this->db->order_by("phone_number", "asc");		
		$by_phone = $this->db->get();
		foreach($by_phone->result() as $row)
		{
			$suggestions[]=$row->phone_number;		
		}
		
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');	
		$this->db->like("account_number",$search);
		$this->db->order_by("account_number", "asc");		
		$by_account_number = $this->db->get();
		foreach($by_account_number->result() as $row)
		{
			$suggestions[]=$row->account_number;		
		}
		
		# only suggest search options containing less than 25(current $limit) characters 
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	
	}
	
	# function to suggest search options when finding customers
	function get_customer_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');	
		$this->db->like('first_name', $search); 
		$this->db->or_like('last_name', $search);
		$this->db->or_like("CONCAT(`first_name`,' ',`last_name`)",$search);		
		$this->db->order_by("last_name", "asc");		
		$by_name = $this->db->get();
		foreach($by_name->result() as $row)
		{
			$suggestions[]=$row->person_id.'|'.$row->first_name.' '.$row->last_name;		
		}
		
		# only suggest search options containing less than 25(current $limit) characters
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}
	
	# function to find customers
	function search($search)
	{
		$this->db->from('customers');
		$this->db->join('people','customers.person_id=people.person_id');		
		$this->db->like('first_name', $search);
		$this->db->or_like('last_name', $search); 
		$this->db->or_like('email', $search); 
		$this->db->or_like('phone_number', $search);
		$this->db->or_like('account_number', $search);
		$this->db->or_like("CONCAT(`first_name`,' ',`last_name`)",$search);
		$this->db->order_by("last_name", "asc");
		
		return $this->db->get();	
	}

}
?>
