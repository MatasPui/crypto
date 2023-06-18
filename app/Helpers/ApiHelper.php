<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class ApiHelper
{
    public function getCurencyList(): array
    {
        $url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => config('data.start'),
            'limit' => config('data.limit'),
            'convert' => config('data.currency')
        ];

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => config('credentials.cointMarketCapKey')
        ];

        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'query' => $parameters
        ]);

        $body = $response->getBody();
        return json_decode($body, true);
    }

    public function getCurrencyMeta(int $id)
    {
        $url = 'https://sandbox-api.coinmarketcap.com/v2/cryptocurrency/info';
        $parameters = [
            'id' => $id,
        ];

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => config('credentials.cointMarketCapKey')
        ];

        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'query' => $parameters
        ]);

        $body = $response->getBody();
        
        return json_decode($body, true);
    }
}