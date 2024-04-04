<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvDisponibilidad extends Model
{

    protected $table      = 'tbl_empleado_disponibilidad';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];

}
