<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvHojaVidaExperienciaTipo extends Model
{
    protected $table      = 'tbl_dv_hoja_vida_experiencia_tipo';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];
}
