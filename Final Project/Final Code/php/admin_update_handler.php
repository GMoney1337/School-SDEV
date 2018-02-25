<?php
/*
	PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	FILE: admin_update_handler.php	
	DATE: 12/6/2017
	PURPOSE: handle POST data from admin.html via admin.js 
		  and interfaces with database to update an entry
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$upd = $_POST;
	$result = $emp->updateEmployee($db,$upd["id"],$upd["names"],$upd["addresses"],$upd["phones"],$upd["salaries"],$upd["ptobalances"],$upd["demographics"],$upd["notes"]);
	echo $result;
?>
