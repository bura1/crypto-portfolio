<?php

namespace Http;

class ApiRequest
{
    public function get()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://rest.coinapi.io/v1/exchanges');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = [];
        $headers[] = 'X-Coinapi-Key: D91B94D7-87EA-47F5-ABE8-ECE81AF0B46C';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}