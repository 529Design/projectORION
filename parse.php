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

foreach ($html->find('ul.event-items div div p, ul.event-items li h3') as $a){//this pulls in the correct data from p and h3 tags

    //echo $a->plaintext.'<br><br>';
    
    switch($stage){
    case 1:
        $tempTitle = $a->plaintext;
        //echo $tempTitle;
        $stage=2;
        break;
    case 2:
        $tempLocation = $a->plaintext.', ';//add coma and space to make location more readable
        //echo $tempLocation.'||||||';
        $stage=3;
        break;
    case 3:
        $whole = $a->plaintext;
        //echo $a->plaintext;
        $pieces = explode("|", $whole);//parses this p tag in list view data delimited by "|"
        $tempLocation.=$pieces[0];//first half is City/Town of event
        $tempTime=$pieces[1];//second half is the time of the event
        $stage=4;
        break;
    case 4:
        //echo $a->plaintext;
        $stage=5;
        break;
    case 5:
        //echo $a->plaintext.'<br>';
        //echo $tempTitle.' '.$tempLocation.' '.$tempTime.'<br><br>';
        $tempEvent = new EventContainer($tempTitle, $tempLocation, $tempTime);
        
        $events[] = $tempEvent;
        $stage=1;
        //echo'sucess<br>';
        break;      
    }
    
}

foreach ($events as $event){
    echo $event->getTitle().'//'.$event->getLocation().'//'.$event->getTime().'<br>';
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