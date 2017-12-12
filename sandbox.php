<?php

include 'simple_html_dom.php'; include 'event.php'; include 'functions.php';


buffaloNewsEventParser('http://thingstodo.buffalonews.com/event/48720/kissmas-bash-2017');


/*BuffaloNewsEventParser - This function extracts price and category info by following a URL
  from the event site and returns the extracted data to be exploded by a delimeter*/
function buffaloNewsEventParser($html){
    
    $html=file_get_html($html);//gets filecontents from passed in URL
    
    $priceCheck = $catCheck = FALSE;//true false checks needed as price and cat info are not formatted the same on each page
    $extractPrice = $extractCat = $extract ="";

    foreach ($html->find('p.special-p') as $a){//iterates through html

        $data = $a->plaintext.' ';//all the text inside p tags is now in data

//finds price
        if($priceCheck == FALSE){
        $price = strstr($data, 'Price:');
            if($price != ""){
                $extractPrice = substr($price, strpos($price, ":") + 1); 
                $priceCheck = TRUE;
            }
        }
//finds category
        if($catCheck ==FALSE){
        $category = strstr($data, 'Category:');
            if($category != ""){
                $extractCat = substr($category, strpos($category, ":") + 1);    
                $catCheck = TRUE;
            }
        }

    }
    $extract = $extractCat . '|' . $extractPrice; //concatenates with | delimeter to be exploded
    //echo $extract;

    return $extract;
}
//END buffaloNewsEventParser *****************************************************


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