<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    
    protected $table = 'departamentos';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_departamento', 'pais_id'];
}

