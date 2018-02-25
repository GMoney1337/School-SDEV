<?php
/*	PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	FILE: user_check.php
	DATE: 12/14/2017
	REVISION TABLE:
	Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
	PURPOSE: called back when user.html is loaded to ensure a redirect from the login page and also to get the information to populate the user page 
*/
	require_once("class.database.php");
	require_once("class.employee.php");
	$db = new database();
	$emp = new employee();

	session_start();

	$results = null;
	if ($_SESSION["id"] != null) {
		$results = $emp->retrieveEmployeeInfo($db,$_SESSION["id"]);	
	}
	session_destroy();
	echo json_encode($results);
?>
