<?php

namespace Fcp\AnimalBreedsSearch;

use Fcp\AnimalBreedsSearch\Exceptions\ProviderException;
use Fcp\AnimalBreedsSearch\Providers\BreedClientInterface;
use Fcp\AnimalBreedsSearch\Providers\CatApi\CatApi;
use Fcp\AnimalBreedsSearch\Providers\DogApi\DogApi;

class AnimalBreeds
{
    public function search(string $type, string $name): array
    {
        $client = $this->getClient($type);

        return $client->search($name);
    }

    private function getClient(string $type): BreedClientInterface
    {
        switch ($type) {
            case 'dog':
                return new DogApi;
            case 'cat':
                return new CatApi();
            default:
                throw new ProviderException('No provider for animal type: ' . $type);
        }
    }
}
