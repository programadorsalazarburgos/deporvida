<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    
    protected $table = 'paises';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_pais'];
}
