<?php

require_once('rabbitMQLib.inc');
require_once('get_host_info.inc');
require_once('path.inc');
require('config.php');

$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
$date = date("Y-m-d", time());

 
$dataOK = true;   $state = -2 ;
$username  = $_GET ["username"];    echo "<br> username:  $username: "; if ( $username == "" ) { $dataOK = false; $state = -1 ; }
$password  = $_GET ["password"];    echo "<br> password:  $password: "; if ( $password == "" ) { $dataOK = false; $state = -1 ; }


$db = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
print "Successfully connected to MySQL.<br><br><br>";
mysqli_select_db( $db, $database);


if (!authenticate ($username, $password, $db))
{
{ $dataOK = false; $state = 0 ; }
echo "Invalid credentials.<br>";= true
header ("Location: index.html");
exit();
}
echo "<br> Passed Credentials test";




$_SESSION ["logged"] = true;
$_SESSION ["username"]   = $username;

echo "<h2> Redirecting to A2protected.php </h2> ";
header ("Location: success.php");
exit();

?>

<?php if ($state == -1 ) { echo "Bad Input. Please enter ucid / password.  $warning<br><br>";} ?>
<?php if ($state ==  0 ) { echo "Invalid Credentials.<br>";} ?>
*/
?>

