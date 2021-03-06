<?php

include 'simple_html_dom.php'; include 'event.php';

//$table_page = file_get_contents('http://thingstodo.buffalonews.com/events/');
// Just keep everything after the "Detailed Forecast" image alt text
//$page = strstr($table_page,'header');
// Find where the forecast <table> starts
//$table_start = strpos($page, '<div class="events-day"');
// Find where the <table> ends
//$table_end = strpos($page, '<div class="overlay">');
// And print a slice of $page that holds the table
//print substr($page, $table_start, $table_end - $table_start);

//print substr($page, $table_start, $table_end - $table_start);

//$test = substr($page, $table_start, $table_end - $table_start);

//GEOCODER***********************************************************************************
function geocode($string){
    
      $string = str_replace (" ", "+", urlencode($string));
      $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
    
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $details_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = json_decode(curl_exec($ch), true);
    
      // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
      if ($response['status'] != 'OK') {
       return null;
      }
    
      //print_r($response);
      $geometry = $response['results'][0]['geometry'];
    
       $longitude = $geometry['location']['lng'];
       $latitude = $geometry['location']['lat'];
    
       $array = array(
           'latitude' => $geometry['location']['lat'],
           'longitude' => $geometry['location']['lng'],
           'location_type' => $geometry['location_type'],
       );
    
       return $array;
    
   }
//END GEOCODER *******************************************************************
    
   //$city = 'castellani art museum, lewiston';
    
   //$array = geocode($city);
   //print_r($array);
   //echo $array['latitude'].',';
   //echo $array['longitude'];


$events = array();

//$tempTitle="something";
//$tempLocation="somewhere";
//$tempTime="sometime";

//$tempEvent = new EventContainer($tempTitle, $tempLocation, $tempTime);

//$events[] = $tempEvent;


//print_r($events);

//could do without P tag would pull in title also and then have to figure out a way to parse further

$html=file_get_html('http://thingstodo.buffalonews.com/events/');

$stage=1;
//div[id=foo]
foreach ($html->find('ul.event-items div div p, ul.event-items li h3, div[class=event-img] a') as $a){//this pulls in the correct data from p and h3 tags

    //echo $a->plaintext.$a->href.'<br><br>';
    
    
    switch($stage){
    case 1:
        $tempLink = $a->href;
        $stage=2;
        break;
    case 2:
        $tempTitle = $a->plaintext;
        //echo $tempTitle;
        $stage=3;
        break;
    case 3:
        $tempLocation = $a->plaintext.', ';//add coma and space to make location more readable
        //echo $tempLocation.'||||||';
        $stage=4;
        break;
    case 4:
        $whole = $a->plaintext;
        //echo $a->plaintext;
        $pieces = explode("|", $whole);//parses this p tag in list view data delimited by "|"
        $tempLocation.=$pieces[0];//first half is City/Town of event
        $tempTime=$pieces[1];//second half is the time of the event
        $array = geocode($tempLocation);
        //print_r($array);
        $tempLatitude = $array['latitude'].', ';
        $tempLongitude = $array['longitude'];
        $stage=5;
        break;
    case 5:
        //echo $a->plaintext;
        $stage=6;
        break;
    case 6:
        //echo $a->plaintext.'<br>';
        //echo $tempTitle.' '.$tempLocation.' '.$tempTime.'<br><br>';
        $tempEvent = new EventContainer($tempLink, $tempTitle, $tempLocation, $tempTime, $tempLatitude, $tempLongitude);
        
        $events[] = $tempEvent;
        $stage=1;
        //echo'sucess<br>';
        break;      
    }
    
}

foreach ($events as $event){
    echo $event->getTitle().', '.$event->getLocation().', '.$event->getTime().', '.
    $event->getLatitude().$event->getLongitude().', '.$event->getLink().'<br>';
}







/*
//TITLE//
$html=file_get_html('http://thingstodo.buffalonews.com/events/');

foreach ($html->find('ul.event-items li h3') as $a){

    echo $a->plaintext.'<br><br>';
}

//location
$html=file_get_html('http://thingstodo.buffalonews.com/events/');

foreach ($html->find('ul.event-items li p a') as $a){

    echo $a->plaintext.'<br><br>';
}




/////$title=$html->find("div#event-details, 0")->plaintext;
//echo $title;

//THIS WORKS
/*
foreach ($html->find('ul.event-items li') as $a){

    echo $a->plaintext.'<br><br>';
}*/

?> 