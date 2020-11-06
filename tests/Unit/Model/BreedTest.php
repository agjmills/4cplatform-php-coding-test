<?php

namespace Tests\Unit\Model;

use App\Models\Breed;
use Fcp\AnimalBreedsSearch\Facades\AnimalBreeds;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BreedTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    public function testSearchRetrievesFromApi()
    {
        $mockedBreed = new \stdClass();
        $mockedBreed->id = 101;
        $mockedBreed->name = 'Russian Blue';
//        AnimalBreeds::shouldReceive('search')->once()->andReturn([$mockedBreed]);

        Breed::search('cat', 'blue');

        $this->assertDatabaseHas('breeds', ['breed' => 'Russian Blue']);
    }

    public function testSearchRetrievesFromDatabase()
    {
        $this->assertDatabaseCount('breeds', 0);

        Breed::factory()->create(['animal_type' => 'cat', 'breed' => 'Siberian']);

        $this->assertDatabaseCount('breeds', 1);

//        AnimalBreeds::shouldReceive('search')->never();
        Breed::search('cat', 'Siberian');
    }
}
