<?php

class CurrentWeatherDetail
{
    public $id;
    public $main;
    public $description;
    public $icon;
    public $temp;
    public $feels_like;
    public $pressure;
    public $humidity;
    public $visibility;

    /**
     * @param $id
     * @param $main
     * @param $description
     * @param $icon
     * @param $temp
     * @param $feels_like
     * @param $pressure
     * @param $humidity
     * @param $visibility
     */
    public function __construct($id, $main, $description, $icon, $temp, $feels_like, $pressure, $humidity, $visibility)
    {
        $this->id = $id;
        $this->main = $main;
        $this->description = $description;
        $this->icon = $icon;
        $this->temp = $temp;
        $this->feels_like = $feels_like;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->visibility = $visibility;
    }


}