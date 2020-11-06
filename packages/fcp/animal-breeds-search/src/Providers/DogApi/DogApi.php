<?php

namespace Fcp\AnimalBreedsSearch\Providers\DogApi;

use Fcp\AnimalBreedsSearch\Providers\BreedClientInterface;
use GuzzleHttp\Client;

class DogApi implements BreedClientInterface
{
    private string $endpoint;

    private string $version;

    private string $apiKey;


    public function __construct()
    {
        $this->endpoint = config('animal-breeds-search.services.thedogapi.endpoint');
        $this->version = config('animal-breeds-search.services.thedogapi.version');
        $this->apiKey = config('animal-breeds-search.services.thedogapi.api_key');
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
