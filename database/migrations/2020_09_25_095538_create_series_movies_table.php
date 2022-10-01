<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('series_url');
            $table->string('series_thumbnail');
            $table->string('series_poster');
            $table->string('description');
            $table->string('series_quality');
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
        Schema::dropIfExists('series_movies');
    }
}
