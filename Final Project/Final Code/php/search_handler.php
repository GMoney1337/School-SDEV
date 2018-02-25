<?php
/*
	PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	FILE: search_handler.php
	DATE: 12/6/2017
	REVISION TABLE:
	Alexander DeForge :: capture POST data and parse into arrays (12/6)
	Alexander DeForge :: implement employee and database classes
	Alexander DeForge :: implemented functionality to search for employee names and id's based off of search criteria (12/14)
	PURPOSE: handle POST data from admin.html via admin.js
                 and query database for basic data from matches,
		  the basic data includes a key which is used
		  to query the full data on that entry
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$srch = $_POST;
	$results = $emp->searchEmployees($db,$srch["names"],$srch["addresses"],$srch["phones"],$srch["salaries"],$srch["ptobalances"],$srch["demographics"],$srch["notes"]);
	echo json_encode($results);
?>
