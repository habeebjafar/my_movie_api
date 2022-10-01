<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesMoviesEpisodes extends Model
{
    use HasFactory;

    public function series(){
        return $this->hasOne('App\Model\SeriesMovies', 'id', 'series_title');
    }
}
