<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BreedSearchRequest;
use App\Http\Requests\BreedUpdateRequest;
use App\Models\Breed;
use Illuminate\Http\JsonResponse;

class BreedController extends Controller
{
    public function search(BreedSearchRequest $request): JsonResponse
    {
        $breeds = Breed::search($request->get('animal_type'), $request->get('name'));

        return $this->response->respond($breeds);
    }

    public function update(BreedUpdateRequest $request, Breed $breed): JsonResponse
    {
        $breed->update($request->validated());

        return $this->response->respond($breed->refresh());
    }
}
