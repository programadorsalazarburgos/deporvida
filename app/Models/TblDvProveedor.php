<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvProveedor extends Model
{ 
    protected $table      = 'tbl_dv_proveedores';
    protected $primarykey = 'id';
    protected $fillable   = ['nombre','telefono','observaciones','direccion','correo'];
}
