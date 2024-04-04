<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{

    protected $table = 'tbl_dv_escenarios';
    protected $primarykey = 'id';
    protected $fillable = ['tipoescenario_id', 'nombre_escenario', 'id_barrio', 'descripcion'];

}





