<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TblGenCiudad extends Model
{
    protected $table      = 'municipios';
    protected $primaryKey = 'id';
    protected $fillable   = ['nombre_municipio', 'departamento_id'];

}
