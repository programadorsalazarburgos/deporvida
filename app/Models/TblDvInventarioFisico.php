<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvInventarioFisico extends Model
{
    protected $table      = 'tbl_dv_inventario_fisico';
    protected $primarykey = 'id';
    protected $fillable   = ['fecha','responsable_user_id','diferencia','observaciones'];
}
