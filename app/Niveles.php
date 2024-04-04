<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{

    protected $table = 'tbl_dv_niveles';
    protected $primarykey = 'id';
    protected $fillable = ['tipoescenario_id', 'nombre_escenario', 'sede_id', 'descripcion'];

}





