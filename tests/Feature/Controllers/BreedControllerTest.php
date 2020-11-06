<?php

namespace Tests\Feature\Controllers;

use App\Models\Breed;
use App\Models\User;
use Fcp\AnimalBreedsSearch\Facades\AnimalBreeds;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BreedControllerTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    public function testUnauthorised()
    {
        $response = $this->getJson('/api/breeds?animal_type=dog&name=brian')->withHeaders([]);

        $this->assertEquals(403, $response->getStatusCode());
    }

    public function testCanSearchForBreeds()
    {
//        AnimalBreeds::shouldReceive('search')->once()->andReturn([]);
//        AnimalBreeds::shouldReceive('providers')->once()->andReturn(['dog']);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/breeds?animal_type=dog&name=brian');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCannotSearchForUnsupportedAnimalTypes()
    {
//        AnimalBreeds::shouldReceive('providers')->once()->andReturn(['dog']);
//        AnimalBreeds::shouldReceive('search')->never();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/breeds?animal_type=goat&name=brian')->withHeaders([]);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testCanUpdateBreed()
    {
        $breed = Breed::factory()->create(['animal_type' => 'cat', 'breed' => 'Siberian']);
        $user = User::factory()->create();
        $response = $this->actingAs($user)->putJson('/api/breeds/' . $breed->id, ['description' => 'I can haz cheezburger?']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('breeds', ['id' => $breed->id, 'description' => 'I can haz cheezburger?']);
    }
}
