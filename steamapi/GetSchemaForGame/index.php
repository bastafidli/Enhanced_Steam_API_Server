<?php
	require_once("../config.php");
		
	$steamid = "";
	if(isset($_GET['steamid'])) { $steamid = mysql_real_escape_string($_GET['steamid']); }
	$appid = mysql_real_escape_string($_GET['appid']);
	$language = "";
	if(isset($_GET['language'])) { $language = mysql_real_escape_string($_GET['language']); }
	
	$url = "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v0002/?key=".$steamAPIkey."&steamid=".$steamid."&appid=".$appid;
	if ($language) { $url = $url."&l=".$language; }
	$url = $url."&format=json";
	$file_headers = @get_headers($url);
	if(strpos($file_headers[0], "Internal Server Error") != 0) { $up = false; }
	else { $up = true; }
	
	if ($up) {		
		$filestring = file_get_contents($url);
		echo $filestring;
	}
	
	exit;
?>