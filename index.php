<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php
include 'functions.php';

//coords for buffalo
//$lat =42.886447;
//$lon =-78.878369;


    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
    }

//Processes form data from launch.php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["location"])) {
        //automatic location using javascript
        }else{
            $tempLocation = $_POST["location"];
            $tempArray = geocode($tempLocation);
            $_SESSION["lat"] = $tempArray['latitude'];
            $_SESSION["lon"] = $tempArray['longitude'];
        }
    }

//load launch screen
    if (!isset($_SESSION['lat']))
    {
        require 'launch.php';
    }
//load main interface
    else{
        require 'nav.php';
        require 'mapGen.php';
    }
    








//create_mysql_table();
//$tempLink=  $tempTitle = $tempLocation = $tempTime = $tempLatitude = $tempLongitude ="";

//$tempEvent = new EventContainer($tempLink, $tempTitle, $tempLocation, $tempTime, $tempLatitude, $tempLongitude);
?>