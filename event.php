<?php

class EventContainer{
    
    protected $title;
    protected $location;
    protected $time;
    //protected $lat;
    //protected $lon;

    public function __construct($title, $location, $time){
        $this->title = $title;
        $this->location = $location;
        $this->time = $time;
    }


    public function getTitle(){return $this->title;}
    public function getLocation(){return $this->location;}
    public function getTime(){return $this->time;}
}
?>

