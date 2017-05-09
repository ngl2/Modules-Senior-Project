<?php

# this interface will keep track of data items
# controllers containing trackable data such as customers or items,
# should implement this interface 
interface iData_controller
{
	public function index();
	public function search();
	public function suggest();
	public function get_row();
	public function view($data_item_id=-1);
	public function save($data_item_id=-1);
	public function delete();
	public function get_form_width();
}
?>