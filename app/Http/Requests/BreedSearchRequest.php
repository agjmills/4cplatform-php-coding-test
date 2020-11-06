<?php

namespace App\Http\Requests;

use Fcp\AnimalBreedsSearch\Facades\AnimalBreeds;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BreedSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'animal_type' => ['required', 'string', Rule::in(AnimalBreeds::providers())],
            'name'        => ['required', 'string', 'min:3'],
        ];
    }
}
