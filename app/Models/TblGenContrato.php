<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenContrato extends Model
{
    protected $table      = 'tbl_gen_contrato';
    protected $primarykey = 'id';
    protected $fillable   = ['id','id_persona','rcp','dcp','contrato_numero','contrato_valor','contrato_objeto','cuotas','fecha_inicio','fecha_terminacion','tenantId','activo'];
}
