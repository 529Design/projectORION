<?php

class EventContainer{
    
    protected $title;
    protected $location;
    protected $time;
    protected $latitude;
    protected $longitude;

    public function __construct($title, $location, $time, $latitude, $longitude){
        $this->title = $title;
        $this->location = $location;
        $this->time = $time;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }


    public function getTitle(){return $this->title;}
    public function getLocation(){return $this->location;}
    public function getTime(){return $this->time;}
    public function getLatitude(){return $this->latitude;}
    public function getLongitude(){return $this->longitude;}
}
?>

