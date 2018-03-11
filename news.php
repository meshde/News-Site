<?php
function getfeed($url){
	$content = file_get_contents($url);
	$xml = new SimpleXmlElement($content);

	$feed = array();
	foreach($xml->channel->item as $entry){
		$item = array (
			'title' => $entry->title,
			'desc' => $entry->description,
			'link' => $entry->link,
			'date' => $entry->pubDate,
		);
	array_push($feed, $item);
	}

	$return = '';
	foreach($feed as $item){
		$title = str_replace(' & ', ' &amp; ', $item['title']);
		$link = $item['link'];
		$description = $item['desc'];
		$date = date('l F d, Y', strtotime($item['date']));

		$return .= '<div class=\'item\'>';
		$return .= '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		$return .= '<small><em>Posted on '.$date.'</em></small></p>';
		$return .= '<p>'.$description.'</p>';
		$return .= '</div>';
		// $return .= '<br>';
	}
	return $return;
}
?>

<?php 
// echo '<div id=1>'.getfeed("https://timesofindia.indiatimes.com/rssfeedstopstories.cms").'</div>'; 
?>
