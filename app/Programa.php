<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    
    protected $table = 'programas';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_programa','descripcion_programa','image'];

}
