<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaEstudioProfesional extends Model
{

    protected $table      = 'tbl_dv_hoja_vida_estudio_profesional';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
		'id_hoja_vida',
		'id_gen_escolaridad_nivel',
		'id_institucion_educativo',
		'id_pais',
		'archivos',
		'estado_estudio',
		'id_titulos_academicos',
		'fecha_grado',
		'tarjeta_profesional',
		'estudio_estado',
		'horario_clases'
    ];

}
