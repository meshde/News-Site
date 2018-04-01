<?php 

header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Credentials: true ");
// header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
// header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
//     X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

include('dbhelper.php');
include('helper.php');

$conn = get_connection_to_db();
$type = $_GET['type'];

$query = 'SELECT url FROM feeds WHERE type=\''.$type.'\';';
$results = $conn->query($query) or die($conn->error);

$content = array();

while($row = mysqli_fetch_assoc($results)) {
	// echo 'Here now in the loop';
	array_push($content, getfeed($row['url'], True));
}

echo json_encode($content);
$conn->close
?>
