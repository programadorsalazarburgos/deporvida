<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenContratoCuota extends Model
{
	protected $table      = 'tbl_gen_contrato_cuota';
    protected $primarykey = 'id';
    protected $fillable   = ['id',
    'id_contrato',
    'valor_saldo',
    'valor_cuota',
    'id_estado',
    'fecha_generacion',
    'cuota_numero'];

}
