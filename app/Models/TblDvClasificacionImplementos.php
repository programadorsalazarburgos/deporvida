<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvClasificacionImplementos extends Model
{
    protected $table      = 'tbl_dv_clasificacion_implementos';
    protected $primaryKey = 'id';
    public $timestamps    = false;
    protected $fillable   = [
        'id',
        'nombre', 
        'observaciones'
    ];
}
