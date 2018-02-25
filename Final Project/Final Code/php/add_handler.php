<?php
/*
	PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky	
	FILE:add_handler.php 
	DATE: 12/7/2017
	REVISION TABLE:
	Alexander DeForge :: capture POST and parse information into arrays (12/7)
	Alexander DeForge :: implemented database and employee classes (12/13)
	Alexander DeForge :: implemented functionality to create employee (12/14)
	PURPOSE: handles the POST from the admin.html page via admin.js
		and interfaces with database to add POSTed information
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$add = $_POST;
	$result = $emp->createEmployee($db,$add["names"],$add["addresses"],$add["phones"],$add["salaries"],$add["ptobalances"],$add["demographics"],$add["notes"]);
	echo $result;
?>
