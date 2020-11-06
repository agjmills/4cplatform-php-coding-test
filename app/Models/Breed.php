<?php

namespace App\Models;

use Fcp\AnimalBreedsSearch\Facades\AnimalBreeds;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    protected $fillable = [
        'animal_type',
        'temperament',
        'breed',
        'alternative_names',
        'life_span',
        'origin',
        'wikipedia_url',
        'country_code',
        'description',
    ];

    public static function search(string $animalType, string $breed)
    {
        $query = self::where('animal_type', $animalType)
            ->where('breed', 'LIKE', '%' . $breed . '%');

        if ($query->count() === 0) {
            collect(AnimalBreeds::search($animalType, $breed))
                ->map(function ($breed) use ($animalType) {
                    return self::create([
                        'animal_type'       => $animalType,
                        'breed'             => $breed->name,
                        'alternative_names' => object_get($breed, 'alt_names'),
                        'life_span'         => object_get($breed, 'life_span'),
                        'origin'            => object_get($breed, 'origin'),
                        'wikipedia_url'     => object_get($breed, 'wikipedia_url'),
                        'country_code'      => object_get($breed, 'country_code'),
                        'description'       => object_get($breed, 'description'),
                        'temperament'       => object_get($breed, 'temperament'),
                    ]);
                });
        }

        return $query->get();
    }
}
