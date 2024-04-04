<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaExperiencia extends Model
{

    protected $table = 'tbl_dv_hoja_vida_experiencia';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_hoja_vida',
        'empresa',
        'jefe_inmediato',
        'direccion',
        'telefono',
        'cargo',
        'correo_empresa',
        'fecha_ingreso',
        'fecha_retiro',
        'tipo_experiencia',
        'archivos'
    ];

}
