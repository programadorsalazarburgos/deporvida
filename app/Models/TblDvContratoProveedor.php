<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvContratoProveedor extends Model
{
    protected $table      = 'tbl_dv_contrato_proveedor';
    protected $primarykey = 'id';
    protected $fillable   = ['no','proveedor_id','descripcion','fecha'];
}
