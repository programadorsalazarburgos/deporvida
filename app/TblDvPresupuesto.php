<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvPresupuesto extends Model
{

    protected $table      = 'tbl_dv_presupuesto';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];

}
