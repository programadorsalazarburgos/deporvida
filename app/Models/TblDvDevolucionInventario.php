<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvDevolucionInventario extends Model
{
    protected $table      = 'tbl_dv_devolucion_inventario';
    protected $primaryKey = 'id';
    protected $fillable   = ['id','fecha','contratista_user_id','comuna_id','observaciones','estado'];
}
