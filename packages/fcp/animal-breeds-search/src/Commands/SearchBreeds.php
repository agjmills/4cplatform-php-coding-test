<?php

namespace Fcp\AnimalBreedsSearch\Commands;

use Fcp\AnimalBreedsSearch\Facades\AnimalBreeds;
use Illuminate\Console\Command;

class SearchBreeds extends Command
{
    protected $signature = 'breeds:search {type} {name}';

    protected $description = 'A command to search breeds by animal type, and name';

    public function handle()
    {
        echo print_r(AnimalBreeds::search($this->argument('type'), $this->argument('name')),1);
    }
}
