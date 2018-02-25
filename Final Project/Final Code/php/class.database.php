

<?php
/*
Version: 1
PROJECT TEAM: Alexander DeForge, Douglas Evert, Pierre Lucceus, Galen Yanofsky
Date: 11/28/2017
Purpose: to create a connection and execution of database activities
Revision Table:
  12/7/2017: adding retrieveUserData function for searching
  12/8/2017: adding comments to identify the different functions
  12/12/2017: Moved the comments and revision table info to inside the php
*/

class database {
    //created this class for a different class but will act as my basic backbone for our database connections
    //this class will allow us to query using prepared statements and will let us execute and fetch those records as well
  private $con;
  private $stmt;
  public function connect(){
    $config = parse_ini_file('/var/conf/config.ini');
    try {
      $this->con = new PDO($config['dsn'], $config['username'], $config['password']);
      return $this->con;
    }catch (exception $e){
      echo '<p>Connection Failure: ' . $e . "</p>";
      return null;
    }
  }

  //prepares the query for execution
  public function query($query){
	try {
    $this->stmt = $this->con->prepare($query);
	} catch (Exception $e) {
	}
  }

  //executes the prepared query
  public function execute(){
    $this->stmt->execute();
  }
  //this function executes the query and returns the results
  public function results(){
    $this->execute();
    $results = array();
    while ($result = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
	$results[] = $result;
    }
    return $results;
  }
}
 ?>
