<?php
/*  PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	FILE:user_update_handler.php
	DATE: 12/6/2017
	REVISION TABLE:
	Alexander DeForge :: capture POST data and parse into array (12/6)
	Alexander DeForge :: implement database and employee classes (12/13)
	Alexander DeForge :: implemented functionality to update only the demographic of an employee displayed via the user page (12/14)
	PURPOSE: handle POST data from user.html via user.js
                  and interfaces with database to update entry 
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	$upd = $_POST;
	$result = $emp->updateEmployee($db,$upd["id"],"","","","","",$upd["demographics"],"");

	echo $result;
?>
