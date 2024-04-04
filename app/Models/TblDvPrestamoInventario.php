<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvPrestamoInventario extends Model
{
    protected $table      = 'tbl_dv_prestamo_inventario';
    protected $primarykey = 'id';
    protected $fillable   = ['fecha','contratista_user_id','comuna_id','observaciones','estado'];
}
