<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEscenarios extends Model
{

    protected $table      = 'tbl_dv_escenarios';
    protected $primaryKey = 'id';
    protected $casts      = [
        'tipoescenario_id' => 'int',
        'sede_id'          => 'int',
        'activo'          => 'int',
        'id_barrio'        => 'int',
        'id_corregimiento' => 'int',
        'id_vereda'        => 'int'
    ];
    protected $fillable   = [
        'activo',
        'nombre_escenario',
        'sede_id',
        'tipoescenario_id',
        'descripcion',
        'direccion',
        'id_barrio',
        'id_corregimiento',
        'id_vereda'
    ];

}
