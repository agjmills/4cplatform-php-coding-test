<?php

namespace Fcp\AnimalBreedsSearch\Providers;

interface BreedClientInterface
{
    public function search(string $name): array;
}
