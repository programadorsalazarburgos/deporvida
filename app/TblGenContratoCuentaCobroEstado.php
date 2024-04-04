<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblGenContratoCuentaCobroEstado extends Model
{
	protected $table      = 'tbl_gen_contrato_cuenta_cobro_estado';
	protected $primarykey = 'id';
	protected $fillable   = ['descripcion'];
}
