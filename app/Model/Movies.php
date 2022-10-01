<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Genre;


class Movies extends Model
{
    use HasFactory;
    

    public function genre(){
        //$genres = Genre::all();
        // $num;
        // foreach ($genres as  $value) {
        //     $num = $this->hasOne('App\Model\Genre', $value->id , 'genres');
        // } 
        // return $num;
        return  $this->hasOne('App\Model\Genre');
        

    }
}
