<?php

namespace Fcp\AnimalBreedsSearch\Providers\CatApi;

use Fcp\AnimalBreedsSearch\Providers\BreedClientInterface;
use GuzzleHttp\Client;

class CatApi implements BreedClientInterface
{
    private string $endpoint;

    private string $version;

    private string $apiKey;

    public function __construct()
    {
        $this->endpoint = config('animal-breeds-search.services.thecatapi.endpoint');
        $this->version = config('animal-breeds-search.services.thecatapi.version');
        $this->apiKey = config('animal-breeds-search.services.thecatapi.api_key');
    }

    public function search(string $name): array
    {
        $client = new Client([
            'base_uri' => $this->endpoint . '/' . $this->version . '/',
            'defaults' => [
                'headers' => ['x-api-key' => $this->apiKey],
            ],
        ]);

        $breeds = $client->get('breeds/search', ['query' => ['q' => $name]])->getBody()->getContents();

        return json_decode($breeds);
    }
}
