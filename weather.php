<?php
include('api_key.php');

function get_image_src($aqi){
	// $base = 'icons/quality/';
	$base = '';
	if ($aqi >= 0 && $aqi <= 50){
		return $base.'good.png';
	}
	if ($aqi > 50 && $aqi <= 150){
		return $base.'moderate.png';
	}
	if ($aqi > 150 && $aqi <=200){
		return $base.'bad.png';
	}
	if ($aqi > 200 && $aqi <=300){
		return $base.'very_bad.png';
	}
	return $base.'die.png';
}

$locations = array(
	array(
		'city' => 'Mumbai',
		'state' => 'Maharashtra'
	),
	array(
		'city' => 'Delhi',
		'state' => 'Delhi'
	),
	array(
		'city' => 'Bengaluru',
		'state' => 'Karnataka'

	)
);

$icon_url = 'http://openweathermap.org/img/w/';

echo '<style>
article {
text-align: center;
display: block;
padding-top: 4%;
padding-bottom: 4%;
}
.airvisual {
    border-left: 6px solid red;
    background-color: lightgrey;
}
.airvisual img {
width: 25%;
height: 8%;
}

</style>';
// echo '<script type="text/javascript">var _mcq=["6",""];</script><span id="_mc_mg6"></span><script language="JavaScript" src="http://stat1.moneycontrol.com/mcjs/common/mc_widget.js"></script><noscript><a href="http://www.moneycontrol.com">Sensex/Nifty</a></noscript>';
for($i=0; $i<sizeof($locations); $i++){
	$url = 'http://api.airvisual.com/v2/city?city='.$locations[$i]['city'];
	$url .= '&state='.$locations[$i]['state'];
	$url .= '&country=INDIA&key='.$quality_key;
	$response = file_get_contents($url);
	// echo $response;
	$json = json_decode($response);
	$locations[$i]['response'] = $json;
}
echo '<section class="airvisual" id="weather">';
foreach($locations as $location){
	$weather = $location['response']->data->current->weather;
	$city = $location['response']->data->city;
	echo '<article>';
	echo '<p><strong>'.$city.'</strong></p>';
	echo '<img src='.$icon_url.$weather->ic.'.png>';
	echo '<p><em>Temperature: </em>'.$weather->tp.'˚C</p>';
	echo '<p><em>Humidity: </em>'.$weather->hu.'%</p>';
	echo '</article>';
}
echo '</section>';
echo '<br><br>';
echo '<section class="airvisual" id="quality">';
foreach($locations as $location){
	$city = $location['response']->data->city;
	$pollution = $location['response']->data->current->pollution;
	echo '<article>';
	echo '<p><strong>'.$city.'</strong></p>';
	echo '<img src='.get_image_src($pollution->aqius).' width=50 height=50>';
	// echo '<img src="icons/quality/1.png">';
	echo '<p><em>AQI: </em>'.$pollution->aqius.'</p>';
	echo '</article>';
}
echo '</section>';
?>
