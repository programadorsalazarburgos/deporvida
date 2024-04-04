<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEstadoAspirante extends Model
{
    protected $table      = 'tbl_dv_estado_aspirante';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];

}
