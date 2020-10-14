<?php
	$username = $_POST['username'];
	$password = $_POST['password'];








	$link = mysql_connect("25.78.212.215", "testuser","Dipish_123!");
	mysql_select_db("IT490PG6");

	if (!$link) {
    die('Could not connect: ' . mysql_error());
}


		$result = mysql_query("select * from Users where username = '$username' and password = '$password'") or die("failed to query database " .mysql_error());

		$row = mysql_fetch_array($result);
		if ($row['username'] == $username && $row['password'] == $password )
		{
				echo "login success!!! Welcome";
		}

		else
    {
			echo "Failed login";
      
		}


		
		?>
