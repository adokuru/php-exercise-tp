<?php

namespace App\Services;

use GuzzleHttp\Client;

class RapidAPIService
{
    private $client;
    private $base_uri = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data';

    public function __construct($symbol = null, $region = 'US')
    {
        $this->client = new Client([
            'base_uri' => $this->base_uri . http_build_query([
                'symbol' => $symbol,
                'region' => $region
            ]),
            'headers' => [
                'x-rapidapi-key' => env('RAPID_API_KEY'),
                'x-rapidapi-host' => env('RAPID_API_HOST'),
                'useQueryString' => true
            ]
        ]);
    }

    public function getCompanyData()
    {
        $response = $this->client->request('GET');
        return json_decode($response->getBody());
    }
}