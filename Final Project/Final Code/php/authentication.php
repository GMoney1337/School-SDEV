

<?php
/* PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
   Date: 12/12/2017
   Purpose: This page is used to authenticate and send users to the right page
   Changes:
		12/12/2017: initial page is created (Douglas Evert)
		12/12/2017: added the die() function to the redirects (Douglas Evert)
		12/12/2017: Modified code to match database (Douglas Evert)
	    12/13/2017: added absolute paths for header locations (Alexander DeForge)
	    12/13/2017: general debugging (Alexander DeForge)
	    12/14/2017: added session functionality to ensure admin and user pages are only functional after a redirect, and not from direct access without login.
*/

//import database class
require_once('class.database.php');
class Authentication {
  private $username;
  private $password;
  private $userResults;

  public function __construct($uname,$pass) {
	$this->username = htmlspecialchars($uname);
	$this->password = $pass;	
  }

  function findUser(){
    //create database Connection
    $databaseConnection = new database();
    $databaseConnection -> connect();
    //query the database for our user
    $sql = ("select * from Accounts where userName = '" . $this->username . "';");
    $databaseConnection -> query($sql);
    //set results to userResults variable
    $this->userResults = $databaseConnection -> results();
  }

  function hashPassword() {
    //set the post information of password to the variable password
    return hash("sha256", $this->password . $this->username, false);
  }

  function authenticate(){
    //set accountPassword to the password field from database results
    $accountPassword = $this->userResults[0]["passWord"];
    //check to make sure user password and database results are the same
    $resul = $this->hashPassword();
    if (strtoupper($accountPassword) === strtoupper($resul)){
      return true;
    } else {
      return false;
    }
  }
  //this function loads the appropriate page
  function pageLoader(){
    $resul = $this->authenticate();
	// if the username/password provided are the same as the hash from the database
    if($resul){
	// if the result from the database is an admin
      if ($this->userResults[0]['adminPriv'] === 'admin'){
	session_start();
	$_SESSION["admin"] = true;
	// redirect to the admin page and start the admin session
	echo "http://ec2-52-90-44-3.compute-1.amazonaws.com/php/admin.php";
	// if the result from the database is a user
      } else if ($this->userResults[0]['adminPriv'] === 'user'){
	echo "http://ec2-52-90-44-3.compute-1.amazonaws.com/site/user.html";
		// redirect to the user page and start the user session
	session_start();
	$_SESSION["id"] = $this->userResults[0]["userId"];
      }
    } else { // if the hashes are different, error
      echo "http://ec2-52-90-44-3.compute-1.amazonaws.com/site/oops.html";
	exit();
    }
  }
}
$authentication = new Authentication($_POST["username"],$_POST["password"]);
//finds the user
$authentication -> findUser();
//loads the appropriate page
$authentication -> pageLoader();
?>
