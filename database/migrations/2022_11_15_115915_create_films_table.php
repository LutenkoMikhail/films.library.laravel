<?php

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('poster')->default(Config::get('constants.no_poster.path'));
            $table->boolean('published')->default(false);
            $table->timestamps();
        });

        Schema::create('film_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Genre::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('films');
            Schema::dropIfExists('genre_film');
        }
    }
};
