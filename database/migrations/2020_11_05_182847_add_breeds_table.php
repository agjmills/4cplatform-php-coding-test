<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBreedsTable extends Migration
{
    public function up(): void
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('animal_type', ['dog', 'cat']);
            $table->string('breed');
            $table->string('temperament')->nullable();
            $table->string('alternative_names')->nullable();
            $table->string('life_span')->nullable();
            $table->string('origin')->nullable();
            $table->string('wikipedia_url')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->text('description')->nullable();
            $table->unique(['animal_type', 'breed']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
}
