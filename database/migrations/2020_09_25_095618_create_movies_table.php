<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('movie_url');
            $table->string('movie_thumbnail');
            $table->string('movie_poster');
            $table->string('description');
            $table->string('movie_quality');
            $table->string('download_url');
            $table->string('actors');
            $table->string('directors');
            $table->string('writers');
            $table->string('rating');
            $table->string('release_date');
            $table->string('countries');
            $table->string('genres');
            $table->string('runtime');
            $table->boolean('is_published');
            $table->boolean('is_downloadable');
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
        Schema::dropIfExists('movies');
    }
}
