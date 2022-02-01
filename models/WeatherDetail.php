<?php

class WeatherDetail
{
    public $lat;
    public $long;
    public $timezone;
    public $timezone_offset;
    public $daily;

    /**
     * @param $lat
     * @param $long
     * @param $timezone
     * @param $timezone_offset
     * @param $daily
     */
    public function __construct($lat, $long, $timezone, $timezone_offset, $daily)
    {
        $this->lat = $lat;
        $this->long = $long;
        $this->timezone = $timezone;
        $this->timezone_offset = $timezone_offset;
        $this->daily = $daily;
    }

}