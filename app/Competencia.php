<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = [
        'nome','definicao','avaliacao_id'
    ];
}