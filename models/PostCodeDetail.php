<?php

class PostCodeDetail
{
    public $adminCode2;
    public $adminCode1;
    public $adminName2;
    public $lng;
    public $countryCode;
    public $postalcode;
    public $adminName1;
    public $placeName;
    public $lat;

    /**
     * @param $adminCode2
     * @param $adminCode1
     * @param $adminName2
     * @param $lng
     * @param $countryCode
     * @param $postalcode
     * @param $adminName1
     * @param $placeName
     * @param $lat
     */
    public function __construct($adminCode2, $adminCode1, $adminName2, $lng, $countryCode, $postalcode, $adminName1, $placeName, $lat)
    {
        $this->adminCode2 = $adminCode2;
        $this->adminCode1 = $adminCode1;
        $this->adminName2 = $adminName2;
        $this->lng = $lng;
        $this->countryCode = $countryCode;
        $this->postalcode = $postalcode;
        $this->adminName1 = $adminName1;
        $this->placeName = $placeName;
        $this->lat = $lat;
    }


}