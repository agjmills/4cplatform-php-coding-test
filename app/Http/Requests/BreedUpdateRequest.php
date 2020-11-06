<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreedUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'breed'             => 'string|nullable',
            'temperament'       => 'string|nullable',
            'alternative_names' => 'string|nullable',
            'life_span'         => 'string|nullable',
            'origin'            => 'string|nullable',
            'wikipedia_url'     => 'url|nullable',
            'country_code'      => 'size:2|nullable',
            'description'       => 'string|nullable',
        ];
    }
}
