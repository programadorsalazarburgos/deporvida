<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvCalificacionesEscala extends Model
{
    protected $table      = 'tbl_dv_calificaciones_escala';
    protected $primarykey = 'id';
    protected $fillable   = ['tipo','numero','nombre','observaciones'];
}
