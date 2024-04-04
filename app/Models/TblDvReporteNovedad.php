<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvReporteNovedad extends Model
{
	protected $table      = 'tbl_dv_novedad_reporte';
    protected $primarykey = 'id';
    protected $fillable   = ['fecha_reporte',
								'nombre_completo',
								'id_metodologo',
								'cedula',
								'telefono',
								'fecha_accidente',
								'hora_accidente',
								'hora_ingreso',
								'direccion_accidente',
								'barrio_accidente',
								'zona',
								'testigo1',
								'cedula1',
								'testigo2',
								'cedula2',
								'relato',
								'observaciones',
								'razon_social',
								'nit',
								'radicado',
								'cargo',
								'fecha_envio_autorizacion',
								'fecha_autorizado',
								'id_departamento',
								'id_municipio',
								'jornada_laboral'
							
							
							
							];
}
