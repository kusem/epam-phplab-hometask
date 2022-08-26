<?php

namespace src\oop\app\src\Transporters;

use GuzzleHttp\Client;

class GuzzleAdapter implements TransportInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @inheritDoc
     */
    public function getContent(string $url): string
    {
        $res = $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36',
                ],
            ]
        );

        return $res->getBody();
    }
}
