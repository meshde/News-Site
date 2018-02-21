<?php
function connection_test() {
	$conn = get_connection();
	echo "Connected successfully";
}

function get_connection() {
	$servername = "localhost:3306";
	$username = "root";
	$password = "meshde123456789"; 

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}
?>

