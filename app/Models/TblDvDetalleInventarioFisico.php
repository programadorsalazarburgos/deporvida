<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDetalleInventarioFisico extends Model
{
    protected $table      = 'tbl_dv_deatalle_inventario_fisico';
    protected $fillable   = ['enbodega','enfisico','inventario_id','implemento_id','diferencia'];
}
