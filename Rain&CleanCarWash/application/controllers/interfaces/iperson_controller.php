<?php 
require_once("idata_controller.php");

# person interface to keep track of people. 
# controllers such as employees and customers should implement this interface
interface iPerson_controller extends iData_controller
{
	public function mailto();
}
?>