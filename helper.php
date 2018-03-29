
<?php
function getfeed($url, $json=False){
	$content = file_get_contents($url);
	$xml = new SimpleXmlElement($content);

	$feed = array();
	foreach($xml->channel->item as $entry){
		$item = array (
			'title' => $entry->title,
			'desc'  => $entry->description,
			'link'  => $entry->link,
			'date'  => $entry->pubDate,
			'img'   => '',
		);
		$item['title'] = str_replace(' & ', ' &amp; ', $item['title']);
		
		if(preg_match("/<a[\s\S]*<\/a>/i",$item['desc'],$v)){
			$img = $v[0];
		}
		else{
		    $img ="<a href='".$item['link']."'><img border='0' hspace='10' align='left' style='margin-top:3px;margin-right:5px;' src='https://raw.githubusercontent.com/meshde/Menews.com/master/menews(mods).png' /></a>";
		}
		$item['img'] = $img;

		$item['desc'] = str_replace($v[0], "", $item['desc']);
		$item['date'] = date('l F d, Y', strtotime($item['date']));
		array_push($feed, $item);
	}

	if ($json == True) {
		return $feed;
	}
	else{
		return echo_results($feed);
	}
}

function echo_results($feed){
	$return = '';
	foreach($feed as $item){
		$link = $item['link'];
		$title = $item['title'];
		$description = $item['description'];
		$img = $item['img'];
		$date = $item['date'];

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
