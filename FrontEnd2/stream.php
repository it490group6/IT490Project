<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

/* Style the header */
.header {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 33.33%;
  padding: 15px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}
</style>
</head>
<body>

<div class="header">
  <h1>Streamers Playing <?php echo $_POST['game'] ?></h1>
<div class="topnav">
  <div class="topnav-centered">
  <a href="success.php">Home</a>
    <a href="about.php">About</a>
    <a href="search.php">Stream Search</a>
    <a href="contact.php">Contact</a>
    <a href="logout.php">Logout</a>
  </div>
</div>  
</body>
</html>
<?php
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();
$game= $_POST['game'];

curl_setopt($ch, CURLOPT_URL, 'https://api.twitch.tv/kraken/streams/?game='.$game);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Accept: application/vnd.twitchtv.v5+json';
$headers[] = 'Client-Id: uoip1x1nprsulbm04qacvud3nbl2my';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);


//return array("streams" => $obj->streams, "channel" => $obj->channel, "display_name"=> $obj->display_name);


//echo $obj;

//echo $obj->game;

//$response = json_decode($result,true);

//print_r('Streamers: '.$response->channel->display_name);


if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

//echo $result;

$result = json_decode($result, true);
//echo json_encode($result, JSON_PRETTY_PRINT);
 
$streams = $result['streams'];
//echo $streams->_id;


// foreach ($result as $key => $value){
	//echo $value;
	foreach($streams as $k => $v){
	//	echo $k.PHP_EOL;
		echo $streams[$k]['channel']['display_name'].": ".$streams[$k]['channel']['url']."<br>"."<br>";

//		echo $v.PHP_EOL;
}
	//echo $streamer['$value']['channel']['display_name'].": ".$streamer['$value']['channel']['url']."\n";
	//print_r($streamer['1']['channel']['display_name'].": ".$streamer['1']['channel']['url']."\n");
	//print_r($streamer['2']['channel']['display_name'].": ".$streamer['2']['channel']['url']."\n");

//	}

/*
for ($x = 0; $x <= count($streams); $x++){
echo $streams['$x']['channel']['display_name'].'<br>';

}
*/

//print_r($result);



//print_r($result->streams->channel->display_name);
?>
