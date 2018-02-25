<?php
/*
	FILE: display_handler.php
	DATE: 12/6/2017
	Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	REVISION HISTORY:
	Alexander DeForge :: capture POST data and parse into arrays (12/6)
	Alexander DeForge :: implement database and employee classes (12/13)
	Alexander DeForge :: implemented functionality to retrieve employee information (12/14)
	PURPOSE: handles POST data from admin.html via admin.js
                  and interfaces with database to obtain data
                  from a search result
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$ident = $_POST["id"];
	$results = $emp->retrieveEmployeeInfo($db,$ident);
	echo json_encode($results);
?>
