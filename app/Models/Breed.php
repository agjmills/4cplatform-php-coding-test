<?php

namespace App\Models;

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
}
