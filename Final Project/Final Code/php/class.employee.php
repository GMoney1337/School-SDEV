
<?php
/*
Version: 1
Author: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
Date: 11/28/2017
Purpose: To Retrieve employee information from the Database
Revision Table:
  12/7/2017: created Initial Document (Douglas Evert)
  12/8/2017: Added field specific functions to query for employeeID (Douglas Evert)
  12/10/2017: Added update and insert functions into the class (Douglas Evert)
  12/12/2017: Added Try blocks to the update and the insert functions (Douglas Evert)
  12/12/2017: Modified code to match database (Douglas Evert)
  12/13/2017: added searchEmployees and removeEmployee functions and edited retrieveEmployeeInfo, updateEmployee, createEmployee (Alexander DeForge)
*/
class employee {
  //declare global variables
  private $name = " ";
  private $address = " ";
  private $phone = " ";
  private $salaries = " ";
  private $ptoBalances = " ";
  private $demographics = " ";
  private $notes = " ";

  //search based on Name
  function nameSearch($database, $name){
    $name = htmlspecialchars($name);
    $database -> query("select employeeID from employees WHERE name = '". $name . " '");
    $employeeID = $database->results();
    retrieveEmployeeInfo($userID);
  }
  //search based on Address
  function addressSearch($database, $address){
    $address = htmlspecialchars($address);
    $database -> query("select EmployeeID from employees WHERE address = '". $address . " '");
    $employeeID = $database->results();
    retrieveEmployeeInfo($userID);
  }

  //search based on phone
  function phoneSearch($database, $phone){
    $phone = htmlspecialchars($phone);
    $database -> query("select employeeID from employees WHERE phone = '". $phone . " '");
    $employeeID = $database->results();
    retrieveEmployeeInfo($employeeID);
  }

  //search based on Demographic
  function demographicSearch($database, $demographic){
    $demographic = htmlspecialchars($demographic);
    $database -> query("select employeeID from employees WHERE demographic = '". $demographic . " '");
    $employeeID = $database->results();
    retrieveEmployeeInfo($employeeID);
  }

  //search based on PTO
  function ptoSearch($database, $lowerPTO, $higherPTO){
    $lowerPTO = htmlspecialchars($lowerPTO);
    $higherPTO = htmlspecialchars($higherPTO);
    $database -> query("select employeeID from employees WHERE PTO >= '". $lowerPTO . "' AND PTO <= '" . $higherPTO . "'");
    $employeeID = $database->results();
    retrieveEmployeeInfo($employeeID);
  }

  //search based on salary
  function salarySearch($database, $lowerSalary, $higherSalary){
    $lowerSalary = htmlspecialchars($lowerSalary);
    $higherSalary = htmlspecialchars($higherSalary);
    $database -> query("select employeeID from employees WHERE PTO >= '". $lowerSalary . "' AND PTO <= '" . $higherSalary . "'");
    $employeeID = $database->results();
    retrieveEmployeeInfo($employeeID);
  }

  //retrieves Data based on employeeID
  function retrieveEmployeeInfo($database, $employeeID){
    $employeeID = $employeeID;
	try {
	$database->connect();
    $database -> query("select * from employees WHERE employeeID = '" . $employeeID . "';");
    return $database->results();
	} catch (Exception $e) {
		return null;
	}
  }
 // single function to search all employee fields
  function searchEmployees($database, $names, $addresses, $phones, $salaries, $ptobalances, $demographics, $notes) {
	// modified to handle any number of entries per field (at the moment the database does not handle this functionality)
	// demographics and notes not currently supported by the database
	$nmstr = "";
	$first = true;
	for ($i = 0; $i < count($names); $i++) {
		if (!$first && $names[$i] !== "") {
			$nmstr .= " OR name='" . $names[$i] . "'";	
		} else if ($names[$i] !== ""){
			$nmstr = " OR name='" . $names[$i] . "'";
			$first = false;
		}
	}
	$addrstr = "";
	$first = true;
	for ($i = 0; $i < count($addresses); $i++) {
		if (!$first && $addresses[$i] !== "") {
			$addrstr .= " OR address='" . $addresses[$i] . "'";	
		} else if ($addresses[$i] !== ""){
			$addrstr = " OR address='" . $addresses[$i] . "'";
			$first = false;
		}

	}
	$phnstr = "";
	$first = true;
	for ($i = 0; $i < count($phones); $i++) {
		if (!$first && $phones[$i] !== "") {
			$phnstr .= " OR phone='" . $phones[$i] . "'";	
		} else if ($phones[$i] !== ""){
			$phnstr = " OR phone='" . $phones[$i] . "'";
			$first = false;
		}

	}

	$salstr = "";
	if ( $salaries[0][0] === "" && $salaries[0][1] === "") {
	} else {
		if ($salaries[0][0] === "") {
			$salaries[0][0] = 0;
		}
		if ($salaries[0][1] === "") {
			$salaries[0][1] = 99999999999;
		}
		$salstr = " OR salaries BETWEEN " . $salaries[0][0] . " AND " . $salaries[0][1];
	}

	$ptostr = "";
	if ( $ptobalances[0][0] === "" && $ptobalances[0][1] === "") {
	} else {
		if ($ptobalances[0][0] === "") {
			$ptobalances[0][0] = 0;
		}
		if ($ptobalances[0][1] === "") {
			$ptobalances[0][1] = 99;
		}
		$ptostr = " OR daysPTO BETWEEN " . $ptobalances[0][0] . " AND " . $ptobalances[0][1];
	}

	try {
		$database->connect();
		$query = ("SELECT employeeID, name FROM employees WHERE employeeID=''" . htmlspecialchars($nmstr) . htmlspecialchars($phnstr) . htmlspecialchars($addrstr) . htmlspecialchars($salstr) . htmlspecialchars($ptostr) . ";");
		$database->query($query);
		return $database->results();
	} catch (Exception $e) {
		return null;
	}
  }

  //set employee variables based on database
  function setEmployeeInfo($info){
    $name = $employee['name'];
    $address = $employee['address'];
    $phone = $employee['phone'];
    $salaries = $employee['salaries'];
    $ptoBalances = $employee['ptoBalances'];
    $demographics = $employee['demographics'];
    $notes = $employee['notes'];

  }
  // function used to create an employee entry into the database
  function createEmployee($database,$names, $addresses, $phones, $salaries, $ptobalances, $demographics, $notes){
	// not optimized to handle multiple entries per field (like searchEmployees is)
	// demographics and notes not currently supported by the database
    $name = htmlspecialchars($names[0]);
    $address = htmlspecialchars($addresses[0]);
    $phone = htmlspecialchars($phones[0]);
    $salaries = htmlspecialchars($salaries[0]);
    $ptoBalances = htmlspecialchars($ptobalances[0]);
    $demographics = htmlspecialchars($demographics[0]);
    $notes = htmlspecialchars($notes[0]);
    try{
      $database->connect();
      $database -> query("INSERT into employees (name, address, phone, salaries, daysPTO) values ( '" . $name ."', '" . $address . "', '" . $phone . "', '" . $salaries . "', '
        " . $ptobalances . "');");
      $database->results();
      echo true;
    }
    catch (Exception $e){
      echo false;
    }
  }
// updates employee record
  function updateEmployee($database, $employeeID, $names, $addresses, $phones, $salaries, $ptobalances, $demographics, $notes){
	// set up to handle multiple entries per field, but this is not currently supported by the database
	// demographics and notes not currently supported by the database
    $employeeID = htmlspecialchars($employeeID);
	$nmstr = "";
	$first = true;
	for ($i = 0; $i < count($names); $i++) {
		if (!$first && $names[$i] !== ""){
			$nmstr .= ", name='" . $names[$i] . "'";
		} else if ($names[$i] !== "") {
			$nmstr .= " name='" . $names[$i] . "'";
			$first = false;
		}
	}
	if ($nmstr !== "") {
		$nmstr .= ",";
	}

	$addrstr = "";
	$first = true;
 	for ($i = 0; $i < count($addresses); $i++) {
		if (!$first && $addresses[$i] !== ""){
			$addrstr .= ", address='" . $addresses[$i] . "'";
		} else if ($addresses[$i] !== "") {
			$addrstr .= " address='" . $addresses[$i] . "'";
			$first = false;
		}
	}
	if ($addrstr !== "") {
		$addrstr .= ",";	
	}

	$phnstr = "";
	$first = true;
 	for ($i = 0; $i < count($phones); $i++) {
		if (!$first && $phones[$i] !== ""){
			$phnstr .= ", phone='" . $phones[$i] . "'";
		} else if ($phones[$i] !== "") {
			$phnstr .= " phone='" . $phones[$i] . "'";
			$first = false;
		}
	}
	if ($phnstr !== "") {
		$phnstr .= ",";
	}

	$salstr = " salaries='" . (string)$salaries[0][0] . "',";
	$ptostr = " daysPTO='" . (string)$ptobalances[0][0] . "'";

    try {
      $database->connect();
      $database->query("UPDATE employees SET" . htmlspecialchars($nmstr) . htmlspecialchars($addrstr) . htmlspecialchars($phnstr) . htmlspecialchars($salstr) . htmlspecialchars($ptostr) . "  WHERE employeeID='" . htmlspecialchars($employeeID) . "';");
      $database->results();
      echo true;
    } catch (Exception $e){
      echo false; 
    }
   }
// remove employee entry from the database
   function removeEmployee($database, $employeeID) {
	$employeeID = htmlspecialchars($employeeID);
	try {
		$database->connect();
		$database->query("DELETE FROM employees WHERE employeeID='" . $employeeID . "';");		
		$database->results();
		return true;
	} catch (Exception $e) {
		return false;
	}
   }
}
?>
