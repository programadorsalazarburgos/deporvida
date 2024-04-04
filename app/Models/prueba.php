<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class prueba extends Model
{

    protected $table = 'prueba_max_insert';
    protected $primarykey = 'id';
    protected $fillable = ['valor_aleatorio'];
}
