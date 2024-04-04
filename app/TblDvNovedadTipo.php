<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvNovedadTipo extends Model
{
    protected $table      = 'tbl_dv_novedad_tipo';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];
}
