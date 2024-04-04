<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEntradaInventario extends Model
{
    protected $table      = 'tbl_dv_entrada_inventario';
    protected $primaryKey = 'id';
    protected $fillable   = ['id','fecha','proveedor_id','observaciones'];
}
