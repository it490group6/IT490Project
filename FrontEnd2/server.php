<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($request) {
	echo "Request received".PHP_EOL;

	if(!isset($request['type'])) {
		return "Error: unsupported message type";
	}

	switch ($request['type']) {

		case "login":
			return doLogin($request['username'], $request['password']);

		case "logout":
			return doLogout($request['logout']);

		case "profile":
			return getProfile($request['username']);

		case "register":
			print_r($request);
			return doRegister($request['username'], $request['email'], $request['password'], $request['firstname'], $request['lastname']);

		case "searchBeer":
			return searchBeer($request['searchBeer']);

		case "searchCategory":
			return searchCategory($request['searchCategory']);
	}

	return array("returnCode" => '0', 'message' => "Server received request and processed");
}


// Functions for beer related
// Searches for specific beer
function searchBeer($beerSearch) {

	try {
		$pdo = new PDO("mysql:host=localhost;dbname=HOP", "root", "root");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo 'Connected Successfully'.PHP_EOL;

	} catch (PDOException $e) {
		echo "Connection Failed: " . $e->getMessage();
	
	}

	$result = $pdo->prepare("SELECT * FROM beer where name = '{$beerSearch}'");
	$result->execute();

	$row = $result->fetchAll();

	if (empty($row)) {
		echo "Could not find '{$beerSearch}' from local database\n";
		echo "Searching through the API database....";

		$client = new rabbitMQClient("testRabbitMQ.ini", "Backend");

		$request = array();
		$request['type'] = "apiBeerSearch";
		$request['searchAPI'] = urlencode($beerSearch);
		$request['message'] = 'API Search for Beer';

		$api_request = $client->send_request($request);

		insertBeer($api_request['name'], $api_request['description'], $api_request['type'], $api_request['available'], $api_request['category']);

		echo "Added Successfully";

		$result = $pdo->prepare("SELECT * FROM beer where name = '{$beerSearch}'");
		$result->execute();

		return $result->fetchAll();

	} else {

		return $row;
	}
}


// Searches for categories of beers
function searchCategory($categorySearch) {
	try {
		$pdo = new PDO("mysql:host=localhost;dbname=HOP", "root", "root");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo 'Connected Successfully'.PHP_EOL;

	} catch (PDOException $e) {
		echo "Connection Failed: " . $e->getMessage();
	
	}

	$result = $pdo->prepare("SELECT * FROM beer where category = '{$categorySearch}'");
	$result->execute();

	$row = $result->fetchAll();

	if (empty($row)) {
		echo "Could not find '{$categorySearch}' from local database\n";
		echo "Searching through the API database....";

		$client = new rabbitMQClient("testRabbitMQ.ini", "Backend");

		$request = array();
		$request['type'] = 'apiCategorySearch';
		$request['searchAPI'] = urlencode($categorySearch);
		$request['message'] = 'API Search for Category';

		$api_request = $client->send_request($request);

		insertBeer($api_request['name'], $api_request['description'], $api_request['type'], $api_request['available'], $api_request['category']);

		echo "Added Successfully";

		$result = $pdo->prepare("SELECT * FROM beer where category = '{$categorySearch}'");

		return $result->fetchAll();
	
	} else {

		return $row;
	}

}


// Insert Beer into LOCAL database for users
function insertBeer($name, $description, $type, $available, $category) {

	try {
		$pdo = new PDO("mysql:host=localhost;dbname=HOP", "root", "root");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		echo 'Connected Successfully'.PHP_EOL;

	} catch (PDOException $e) {
		echo "Connection Failed: " . $e->getMessage();
	
	}

	$statement = $pdo->prepare("INSERT INTO beer (name, description, type, available, category) VALUES (:name, :description, :type, :available, :category)");

	$statement->bindParam(':name', $name);
	$statement->bindParam(':description', $description);
	$statement->bindParam(':type', $type);
	$statement->bindParam(':available', $available);
	$statement->bindParam(':category', $category);

	$statement->execute();

}

// Functions for User Profiling.
// Adds user to the localdatabase

function doLogin($username, $password) {

require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
try{
  $db = new PDO($conn_string, $username, $password);
  
  $stmt = $db->query("SELECT * FROM Accounts WHERE username = '$enteredUsername'");
  $result = $stmt->fetch();
  $row = $result
 
  if($result['username'] == $username){   
     if($result['password'] == $password)
      {
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['password'] = $result['password'];
      
        echo "successful login";
      }
      else
      {
        echo "fail login";
      }
  }
  
  
  else
  {
    echo "fail login";
  }
}  

function doRegister($username, $email, $password, $firstname, $lastname) {
require('config.php');
$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
$db = new PDO($conn_string, $username, $password);


$stmt = $db->query("SELECT * from Login");
$result = $stmt->fetch();


  $User = $_POST['username'];
  $Pass = $_POST['password'];
  $cPass = $_POST['confirmPassword'];
  
//checks if password entered and confirmation are equal
if(strlen($Pass) > 0 && $Pass == $cPass){
  $hashed = hash('sha256', $Pass);//this hashes the password so no one can see the password
  $insert_query = "INSERT INTO users (username, email, firstname, lastname, password) VALUES (NULL, '$User', '$hashed')";
  $stmt = $db->prepare($insert_query);
  $r = $stmt->execute();
 	

}

function getProfile($username) {
	$date = date("Y-m-d");
	$time = date("h:m:sa");

	try {
		$pdo = new PDO("mysql:host=localhost;dname=HOP", "root", "root");
		$pdo->setAttribute(PDO::ATTR_ERRRMODE, PDO::ERRMODE_EXCEPTION);

		echo "Connected Successsfully".PHP_EOL;

	} catch (PDOException $e) {
		echo "Connection Failed: ". $e->getMessage();

	}

	$result = $pdo->prepare("SELECT * from users WHERE username = '{$username}'");
	$result->exec();
	$row = $result->fetchAll();

	return $row;


}

$server = new rabbitMQServer("testRabbitMQ.ini", "Frontend");
$server->process_requests('requestProcessor');

exit();

?>
