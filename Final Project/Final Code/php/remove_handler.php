<?php
/*
	PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	FILE: remove_handler.php
	DATE: 12/6/2017
	REVISION TABLE:
	Alexander DeForge :: capture POST data and parse into arrays (12/6)
	Alexander DeForge :: implement database and employee classes (12/13)
	Alexander DeForge :: implemented functionality to remove an employee entry from the database (12/14)
	PURPOSE: handle POST data from admin.html via admin.js
                  and interfaces with database to remove entry
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$ident = $_POST;
	$result = $emp->removeEmployee($db,$ident["id"]);

	echo $result;
?>
