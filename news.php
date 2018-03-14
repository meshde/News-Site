
<?php 
// echo '<div id=1>'.getfeed("https://timesofindia.indiatimes.com/rssfeedstopstories.cms").'</div>'; 

include('dbhelper.php');
include('helper.php');
$conn = get_connection_to_db();
$type = $_GET['type'];
// echo "I'm here";
$query = 'SELECT url FROM feeds WHERE type=\''.$type.'\';';
$results = $conn->query($query) or die($conn->error);

$content = '<style>

.item {
  float: left;
  
  width: 100%;
  height: 150px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
  overflow: hidden;
  background: white;
  color: #808080;
  border-radius: 6px;
  padding-bottom: 0px;
  padding-top: 0px;
  box-shadow: 4px 4px rgba(0, 0, 0, .3);
}
.item img {
padding-top: 5px;
    padding-left: 1px;
    padding-bottom: 5px;
    padding-right: 5px;
    height: 88%;
    width: 25%;
    border-radius: 10px;
}
</style>';
while($row = mysqli_fetch_assoc($results)) {
	// echo 'Here now in the loop';
	$content .= getfeed($row['url']);
}
echo $content;
$conn->close
?>
