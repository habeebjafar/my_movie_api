<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function subject(){
        return $this->hasOne('App\Model\Subject', 'id', 'subject_id');
    }

    public function topic(){
        return $this->hasOne('App\Model\SubjectTopics', 'id', 'topic_id');
    }
    
}
