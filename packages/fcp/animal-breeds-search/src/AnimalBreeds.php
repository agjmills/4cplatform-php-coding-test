<?php

namespace Fcp\AnimalBreedsSearch;

use Fcp\AnimalBreedsSearch\Exceptions\ProviderException;
use Fcp\AnimalBreedsSearch\Providers\BreedClientInterface;
use Fcp\AnimalBreedsSearch\Providers\CatApi\CatApi;
use Fcp\AnimalBreedsSearch\Providers\DogApi\DogApi;

class AnimalBreeds
{
    const PROVIDERS = [
        'dog' => DogApi::class,
        'cat' => CatApi::class,
    ];

    public function search(string $type, string $name): array
    {
        $client = $this->getClient($type);

        return $client->search($name);
    }

    public function providers(): array
    {
        return array_keys(self::PROVIDERS);
    }

    private function getClient(string $type): BreedClientInterface
    {
        if (array_key_exists($type, self::PROVIDERS)) {
            $provider = self::PROVIDERS[$type];

            return new $provider;
        }

        throw new ProviderException('No provider for animal type: ' . $type);
    }
}
