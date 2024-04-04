<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class Institucion extends Model
{
    
    protected $table = 'instituciones';
    protected $primarykey = 'id';
    protected $fillable = ['nombre_institucion', 'codigo_dane', 'telefono', 'direccion', 'nombre_rector', 'barrio_id'];



  function getIdAttribute($value)
      {
	    
	    $hashids = new Hashids('', 10);
	   	return $hashids->encode($value);

      }



}







