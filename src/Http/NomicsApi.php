<?php

namespace Http;

class NomicsApi
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }


    public function getDataForTickers(string $tickers, string $convert)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,
            'https://api.nomics.com/v1/currencies/ticker' .
            '?key=' . $this->apiKey .
            '&ids=' . $tickers .
            '&convert=' . $convert);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $headers = [];
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}