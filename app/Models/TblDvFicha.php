<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvFicha extends Model
{

    protected $table      = 'tbl_dv_ficha';
    protected $primaryKey = 'id';
    protected $casts      = [
        'id_persona_beneficiario'         => 'int',
        'id_escolaridad_nivel'            => 'int',
        'id_escolaridad_estado'           => 'int',
        'id_etnia'                        => 'int',
        'id_persona_acudiente'            => 'int',
        'id_persona_acudiente_parentesco' => 'int',
        'id_persona_vive_con_parentesco'  => 'int',
        'id_salud_regimen'                => 'int',
        'id_ocupacion'                    => 'int',
        'id_eps'                          => 'int',
        'tiene_discapacidad'              => 'int',
        'toma_medicamentos'               => 'int',
        'vinculado'                       => 'int',
        'id_motivo'                       => 'int',
    ];
    protected $dates = [
        'fecha_registro',
        'fecha_retiro'
    ];
    protected $fillable = [
        'toma_medicamentos',
        'fecha_registro',
        'tiene_discapacidad',
        'id_persona_beneficiario',
        'id_ocupacion',
        'id_escolaridad_nivel',
        'id_escolaridad_estado',
        'id_etnia',
        'id_persona_acudiente',
        'id_persona_acudiente_parentesco',
        'id_persona_vive_con_parentesco',
        'enfermedad_padece_si',
        'enfermedad_padece_nombre',
        'medicamentos_toma_si',
        'medicamentos_toma_nombre',
        'salud_afiliado',
        'id_salud_regimen',
        'id_eps',
        'participacion_anterior_meses',
        'participacion_anterior_annos',
        'grupo_poblacional_otro',
        'persona_acudiente_parentesco_otro',
        'persona_vive_con_parentesco_otro',
        'vinculado',
        'id_motivo'
    ];

    public function tbl_gen_persona()
    {
        return $this->belongsTo(\App\Models\TblGenPersona::class, 'id_persona_acudiente');
    }

    public function tbl_gen_escolaridad_nivel()
    {
        return $this->belongsTo(\App\Models\TblGenEscolaridadNivel::class, 'id_escolaridad_nivel');
    }

    public function tbl_gen_escolaridad_estado()
    {
        return $this->belongsTo(\App\Models\TblGenEscolaridadEstado::class, 'id_escolaridad_estado');
    }

    public function tbl_gen_etnium()
    {
        return $this->belongsTo(\App\Models\TblGenEtnium::class, 'id_etnia');
    }

    public function tbl_gen_parentesco()
    {
        return $this->belongsTo(\App\Models\TblGenParentesco::class, 'id_persona_vive_con_parentesco');
    }

    public function tbl_gen_salud_regiman()
    {
        return $this->belongsTo(\App\Models\TblGenSaludRegiman::class, 'id_salud_regimen');
    }

    public function tbl_gen_ep()
    {
        return $this->belongsTo(\App\Models\TblGenEp::class, 'id_eps');
    }

}
