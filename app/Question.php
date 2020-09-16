<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
      'id',
      'topic_id',
      'question',
      'a',
      'b',
      'c',
      'd'
    ];

    public function answers() {
      return $this->hasOne('App\Answer');
    }

    public function topic() {
      return $this->belongsTo('App\Topic');
    }
 
}
