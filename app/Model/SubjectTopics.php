<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTopics extends Model
{
    use HasFactory;

    public function mysubject(){
        return $this->hasOne('App\Model\Subject', 'id', 'subject_id');
    }

    // protected $fillable = [
    //     'subject_id','topic','icon'
    //   ];
}
