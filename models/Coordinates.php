<?php

class Coordinates
{
    public $zip;
    public $name;
    public $lat;
    public $lon;
    public $country;

    /**
     * @param $zip
     * @param $name
     * @param $lat
     * @param $lon
     * @param $country
     */
    public function __construct($zip, $name, $lat, $lon, $country)
    {
        $this->zip = $zip;
        $this->name = $name;
        $this->lat = $lat;
        $this->lon = $lon;
        $this->country = $country;
    }

}