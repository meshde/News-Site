
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

		if(preg_match("/<a[\s\S]*<\/a>/i",$item['desc'],$v)){
			$img = $v[0];
		}
		else{
		    $img ="<a href='".$item['link']."'><img border='0' hspace='10' align='left' style='margin-top:3px;margin-right:5px;' src='https://raw.githubusercontent.com/meshde/Menews.com/master/menews(mods).png' /></a>";
		}

		$description = str_replace($v[0], "", $item['desc']);
		$date = date('l F d, Y', strtotime($item['date']));

		$return .= '<div class=\'item\' data-link=\''.$link.'\'>';
		$return .= $img;
		$return .= '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		$return .= '<small><em>Posted on '.$date.'</em></small></p>';
		$return .= '<p>'.$description.'</p>';
		$return .= '</div>';
		// $return .= '<br>';
	}
	return $return;
}
?>
