<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvAsistencias extends Model
{

    protected $table      = 'tbl_dv_asistencias';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
        'id_grupo', 
        'id_persona_beneficiario', 
        'fecha_asistencia', 
        'fecha_creacion', 
        'siasistio',
        'observacion'
    ];

}
