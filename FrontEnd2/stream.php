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
