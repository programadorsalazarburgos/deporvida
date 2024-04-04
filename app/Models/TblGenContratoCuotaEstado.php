<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenContratoCuotaEstado extends Model
{
    protected $table      = 'tbl_gen_contrato_cuota_estado';
	protected $primarykey = 'id';
	protected $fillable   = ['descripcion'];
}
