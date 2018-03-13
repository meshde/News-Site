<?php
	// echo "<ul>";
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

function create_database($db='menews') {
	$conn = get_connection();

	// Create Database
	$sql = "CREATE DATABASE IF NOT EXISTS ".$db;
	$op = "Database Creation";
	run_query($conn, $sql, $op);

	// Select Database
	$conn->select_db('menews');

	// Create Users Table
	$op = "Users Table Creation";
	$user_table = 'CREATE TABLE users('.
		'username VARCHAR(255),'.
		'password VARCHAR(32),'.
		'email VARCHAR(255));';
	run_query($conn, $user_table, $op);

	// Create Feeds Table
	$op = "Feeds Table Creation";
	$feed_table = 'CREATE TABLE feeds('.
		'type VARCHAR(255),'.
		'url VARCHAR(255));';
	run_query($conn, $feed_table, $op);

	mysqli_close($conn);
}

function run_query(&$conn, $sql, $op){
	if($conn->query($sql) == TRUE){
		echo $op." Successful";
	}
	else {
		echo $op." Error: ".$conn->error;
	}
	echo "<br>";
}

function get_connection_to_db($db='menews'){
	$conn = get_connection();
	$conn->select_db($db);

	if ($result = $conn->query("SELECT DATABASE()")) {
		$row = $result->fetch_row();
		if ($row[0] != $db){
			die($row[0].' was selected instead!');
		}
		$result->close();
	}
	return $conn;
}

function delete_database($db='menews') {
	$conn = get_connection_to_db($db);
	$sql = 'DROP DATABASE IF EXISTS '.$db;
	$op = 'Delete Database';

	run_query($conn, $sql, $op);
}

function fill_database() {
	$conn = get_connection_to_db('menews');

	// Insert into Users Table
	$users = array(
		array(
			'username'  => 'meshde',
			'password'  => md5('meshde'),
			'email'  => 'meshde@menews.com',
		),
		array(
			'username'  => 'mehmood.d',
			'password'  => md5('mehmood.d'),
			'email'  => 'mehmood.d@menews.com',
		),
		array(
			'username'  => 'admin',
			'password'  => md5('admin'),
			'email'  => 'admin@menews.com',
		),
	);

	foreach($users as $user){
		$sql = "INSERT INTO users (username, email, password) ".
			"VALUES('".$user['username']."', '".$user['email'].
			"', '".$user['password']."');";

		run_query($conn, $sql, "Insert into Users");
	}

	$feeds = array(
		array(
			'type' => 'Home',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/1221656.cms',
		),
		array(
			'type' => 'India',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/-2128936835.cms',
		),
		array(
			'type' => 'World',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/296589292.cms',
		),
		array(
			'type' => 'Business',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/1898055.cms',
		),
		array(
			'type' => 'Sports',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/4719148.cms',
		),
		array(
			'type' => 'Health',
			'url' => 'https://timesofindia.indiatimes.com/rssfeeds/3908999.cms',
		),
		array(
			'type' => 'Home',
			'url' => 'http://www.dnaindia.com/feeds/analysis.xml',
		),
		array(
			'type' => 'India',
			'url' => 'http://www.dnaindia.com/feeds/india.xml',
		),
		array(
			'type' => 'World',
			'url' => 'http://www.dnaindia.com/feeds/world.xml',
		),
		array(
			'type' => 'Business',
			'url' => 'http://www.dnaindia.com/feeds/business.xml',
		),
		array(
			'type' => 'Sports',
			'url' => 'http://www.dnaindia.com/feeds/sport.xml',
		),
		array(
			'type' => 'Health',
			'url' => 'http://www.dnaindia.com/feeds/health.xml',
		),
	);

	foreach($feeds as $feed){
		$sql = "INSERT INTO feeds (type, url) ".
			"VALUES('".$feed['type']."', '".$feed['url']."');";

		run_query($conn, $sql, "Insert into Feeds");
	}
}

?>
