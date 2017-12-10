<?php

include 'simple_html_dom.php'; include 'event.php'; include 'functions.php';


buffaloNewsTestParser();

function buffaloNewsTestParser(){
    
    $html=file_get_html('http://thingstodo.buffalonews.com/event/48637/heritage-discovery-center-research-library');
    
    //$stage=1;
    //div[id=foo]
    //$conn = Connect();
    //foreach ($html->find('ul.event-items div div p, ul.event-items li h3, div[class=event-img] a') as $a)
    foreach ($html->find('p.special-p') as $a){//this pulls in the correct data from p and h3 tags
    
        echo $a->plaintext.'<br><br>';
             //
        //$conn->close();//closes the connection
        
        /*
        switch($stage){
        case 1:
            $tempLink = $a->href;
            echo $tempLink.', ';
            $stage=2;
            break;
        case 2:
            $tempTitle = $a->plaintext;
            echo $tempTitle;
            $stage=3;
            break;
        case 3:
            $tempLocation = $a->plaintext.', ';//add coma and space to make location more readable
            echo $tempLocation.', ';
            $stage=4;
            break;
        case 4:
            $whole = $a->plaintext;
            echo $a->plaintext.', ';
            $stage=5;
            break;
        case 5:
            echo $a->plaintext.', ';
            $stage=6;
            break;
        case 6:
            echo $a->plaintext.'<br>';
            //echo $a->tag.'<br>';
            //echo $tempTitle.' '.$tempLocation.' '.$tempTime.'<br><br>';
            //$tempEvent = new EventContainer($tempLink, $tempTitle, $tempLocation, $tempTime, $tempLatitude, $tempLongitude);
            //InsertEvent($tempEvent, $conn);
            //$events[] = $tempEvent;
            //echo '<br>';
            $stage=1;
            //echo'sucess<br>';
            break;  
               
        }
         */
    }
    
    //$conn->close();//closes the connection
    
    /*
    foreach ($events as $event){
        echo $event->getTitle().', '.$event->getLocation().', '.$event->getTime().', '.
        $event->getLatitude().$event->getLongitude().', '.$event->getLink().'<br>';
    }
    */
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