<?php
require "models/Coordinates.php";
require "models/WeatherDetail.php";
require "models/PostCodeDetail.php";
require "models/CurrentWeatherDetail.php";
require_once "helpers/ApiKey.php";
require_once "helpers/Username.php";

$weather = null;
$coords = null;
$postCodeDetail = null;
$currentWeatherDetail = null;
$errPostCode = "";

function url_get_contents ($Url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output);
}

if(isset($_GET['postCode'])) {
    $postCode = $_GET['postCode'];
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (empty($_GET["postCode"])) {
            $errPostCode = "Please enter a valid post code";
        } else {
            if (!preg_match("/^\d{3}-\d{4}$/", $postCode)) {
                $errPostCode = "7-digit numeric codes using the format NNN-NNNN allowed";
            } else {
                $cordUrl = "https://api.openweathermap.org/geo/1.0/zip?zip=" . $postCode . ",jp&appid=" . $apiKey;
                $resultCords = url_get_contents($cordUrl);
                if (isset($resultCords->cod) && $resultCords->cod == "404") {
                    $errPostCode = "Could not find city, please try again.";
                } else {
                    $coords = new Coordinates($resultCords->zip, $resultCords->name, $resultCords->lat, $resultCords->lon, $resultCords->country);

                    $weatherDetailUrl = "https://api.openweathermap.org/data/2.5/onecall?lat=" . $coords->lat . "&lon=" . $coords->lon . "&exclude=current,minutely,hourly,alert&appid=" . $apiKey . "&units=metric";
                    $resultWeatherDetail = url_get_contents($weatherDetailUrl);
                    $weather = new WeatherDetail($resultWeatherDetail->lat, $resultWeatherDetail->lon, $resultWeatherDetail->timezone, $resultWeatherDetail->timezone_offset, array_slice($resultWeatherDetail->daily, 0, 3));

                    $postCodeDetailUrl = "http://api.geonames.org/postalCodeLookupJSON?postalcode=" . $postCode . "&country=JP&username=" . $username;
                    $resultPostCodeDetail = url_get_contents($postCodeDetailUrl);
                    $resultPCD = $resultPostCodeDetail->postalcodes;
                    $postCodeDetail = new PostCodeDetail($resultPCD[0]->adminCode2, $resultPCD[0]->adminCode1, $resultPCD[0]->adminName2, $resultPCD[0]->lng, $resultPCD[0]->countryCode, $resultPCD[0]->postalcode, $resultPCD[0]->adminName1, $resultPCD[0]->placeName, $resultPCD[0]->lat);

                    $currentDetailUrl = "https://api.openweathermap.org/data/2.5/weather?lat=". $resultCords->lat . "&lon=" . $resultCords->lon . "&appid=" . $apiKey .  "&units=metric";
                    $resultCurrentDetail = url_get_contents($currentDetailUrl);
                    $currentWeatherDetail = new CurrentWeatherDetail($resultCurrentDetail->weather[0]->id, $resultCurrentDetail->weather[0]->main, $resultCurrentDetail->weather[0]->description, $resultCurrentDetail->weather[0]->icon, $resultCurrentDetail->main->temp, $resultCurrentDetail->main->feels_like, $resultCurrentDetail->main->pressure, $resultCurrentDetail->main->humidity, $resultCurrentDetail->visibility);
                }
            }
        }
    }
}