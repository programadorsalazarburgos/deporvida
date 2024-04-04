<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenContratoCuentaCobro extends Model
{
	protected $table      = 'tbl_gen_contrato_cuenta_cobro';
	protected $primarykey = 'id';
	protected $fillable   = [
		'id','id_cuenta_cobro_estado','fecha_transaccion','planilla_numero','pin_numero','operador','fecha_pago','periodo_pago_seguridad_social','fecha_plazo_ejecucion','tareas_supervisor','tareas_informe_mensual','id_contrato_cuota','revaluacion'];
}
