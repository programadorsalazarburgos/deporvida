<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    
    protected $table = 'barrios';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_barrio', 'comuna_id','codigo','id_estrato'];

}
