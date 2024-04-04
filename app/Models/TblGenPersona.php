<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenPersona extends Model
{
	protected $table = 'tbl_gen_persona';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $casts = [
		'id_documento_tipo' => 'int',
		'id_procedencia_pais' => 'int',
		'id_procedencia_municipio' => 'int',
		'id_procedencia_departamento' => 'int',
		'id_residencia_corregimiento' => 'int',
		'id_residencia_barrio' => 'int',
		'id_residencia_vereda' => 'int'
	];

	protected $dates = [
		'fecha_nacimiento'
	];

	protected $fillable = [
		'nombre_primero',
		'nombre_segundo',
		'apellido_primero',
		'apellido_segundo',
		'documento',
		'id_documento_tipo',
		'sexo',
		'fecha_nacimiento',
		'telefono_fijo',
		'telefono_movil',
		'correo_electronico',
		'id_procedencia_pais',
		'id_procedencia_municipio',
		'id_procedencia_departamento',
		'id_residencia_corregimiento',
		'id_residencia_barrio',
		'id_residencia_vereda',
		'residencia_direccion',
		'residencia_estrato',
		'sangre_tipo',
		'nuevo'
	];

	public function tbl_gen_documento_tipo()
	{
		return $this->belongsTo(\App\Models\TblGenDocumentoTipo::class, 'id_documento_tipo');
	}

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_persona_acudiente');
	}

	public function tbl_dv_persona_x_discapacidads()
	{
		return $this->hasMany(\App\Models\TblDvPersonaXDiscapacidad::class, 'id_persona');
	}

	public function tbl_dv_persona_x_ocupacions()
	{
		return $this->hasMany(\App\Models\TblDvPersonaXOcupacion::class, 'id_persona');
	}

	public function tbl_gen_persona_x_grupo_poblacionals()
	{
		return $this->hasMany(\App\Models\TblGenPersonaXGrupoPoblacional::class, 'id_persona');
	}
}
