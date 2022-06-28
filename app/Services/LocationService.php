<?php

namespace App\Services;

class LocationService
{
    public function getLatAndLngFromAddress($location){
        $address = $location; // Google HQ
        $prepareAddress = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepareAddress.'&sensor=false&key='.env('GOOGLE_API_KEY'));
        $output= json_decode($geocode);

        $result['latitude'] = $output->results[0]->geometry->location->lat;
        $result['longitude'] = $output->results[0]->geometry->location->lng;
        return $result;
    }

    public function getAddressFromLatLng($latitude, $longitude){
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false&key='.env('GOOGLE_API_KEY'));
        $output= json_decode($geocode);
        $result['formatted_address'] = $output->results[0]->formatted_address;
        return $result;
    }
}
