<?php

//load the file
//open the file
//read the file
$contents = file_get_contents($argv[1]);

//convert data into a usable format
$framedata = json_decode($contents);
//print_r($framedata);

//insert data into database
$servername = "localhost";
$username = "user";
$password = "pass";
$dbname = "tekkenchicken";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
}

foreach ($framedata->moves as $member){
//	print_r($member);
	$insert = "INSERT INTO movelist "
		. "(charname, notation, hitlevel, damage, speed, onblock, "
		. "onhit, onch, notes) VALUES "
		. "(\"" . $conn->real_escape_string($argv[2]) . "\", \"" 
		. $conn->real_escape_string($member->notation) . "\", \"" 
		. $conn->real_escape_string($member->hit_level) . "\", \"" 
		. $conn->real_escape_string($member->damage) . "\", \"" 
		. $conn->real_escape_string($member->speed) . "\", \"" 
		. $conn->real_escape_string($member->on_block) . "\", \"" 
		. $conn->real_escape_string($member->on_hit) . "\", \"" 
		. $conn->real_escape_string($member->on_ch) . "\", \"" 
		. $conn->real_escape_string($member->notes) . "\")"
		;
	//print $insert . "\n";
	$conn->query($insert);
}

?>
