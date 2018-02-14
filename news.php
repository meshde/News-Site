<?php
function getfeed($url){
	$content = file_get_contents($url);
	$xml = new SimpleXmlElement($content);

	echo "<ul>";
	foreach($xml->channel->item as $entry){
		echo "<li><a href='$entry->link'>".$entry->title."</a></li>";
	}
	echo "</ul";
}
?>

<?php getfeed("https://timesofindia.indiatimes.com/rssfeedstopstories.cms"); ?>
