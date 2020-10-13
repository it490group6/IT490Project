<?php
// Database Connection Setting Remotely 
$hostname= "25.78.212.215" ;
$username="testuser";
$password="Dipish_123!";
$database="IT490PG6";
$mysqli = new mysqli($hostname, $username, $password, $database);
$mysqli->select_db($database) or die( "Unable to select database");
print "<br>Successfully connected to MySQL.<br>";
?>
