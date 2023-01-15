<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class UserService 
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getUsers(): array
    {

        $response = $this->client->request(
            'GET',
            'http://localhost:4000/getallusers',
            [
                'headers' => [
                    'Contect-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'auth_bearer' => ['bearer-token','24323423443sf']
                ],            
            ]);
        $content = $response->getContent();
        $decoded = json_decode($content);

        $plain = str_replace('"',' ',$decoded[0]->firstName);
        dd($plain);
        // $array_final = json_encode($decoded[0]->firstName, JSON_NUMERIC_CHECK);
        // dd($array_final);

        //dd($decoded[0]->firstName);
        return $response->toArray();
    }

}
