<?php

header("Access-Control-Allow-Origin: *");

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

$sql = "SELECT * FROM movelist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$movelist = array();
	// Output data of each row
	while($row = $result->fetch_assoc()) {
		$movelist[$row["charname"]]["moves"][] = array(
			"notation" => $row["notation"],
			"hit_level" => $row["hitlevel"],
			"damage" => $row["damage"],
			"speed" => $row["speed"],
			"on_block" => $row["onblock"],
			"on_hit" => $row["onhit"],
			"on_ch" => $row["onch"],
			"notes" => $row["notes"],
			"move_name" => $row["movename"]
		);
	}

	echo json_encode($movelist);
}	else {
		echo "0 results";
}
$conn->close();

?>
