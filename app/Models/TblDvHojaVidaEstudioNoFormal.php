<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaEstudioNoFormal extends Model
{

    protected $table      = 'tbl_dv_hoja_vida_estudio_no_formal';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
		'id_hoja_vida',
		'titulo',
		'curso_tipo',
		'id_institucion_educativo',
		'horas_cursadas'
    ];

}
