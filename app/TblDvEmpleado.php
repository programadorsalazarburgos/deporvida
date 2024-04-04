<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TblDvEmpleado extends Model
{

    protected $table      = 'tbl_dv_empleado';
    protected $primarykey = 'id';
    protected $fillable   = [
        'id_persona',
        'id_institucion_educativa',
        'id_usuario',
        'id_presupuesto',
        'id_estado_aspirante',
        'tiene_hijos',
        'cuantos_hijos',
        'libreta_militar',
        'no_libreta_militar',
        'distrito_militar',
        'skype',
        'id_disponibilidad',
        'foto',
        'profesion',
        'id_disciplina',
        'id_ocupacion',
        'tiene_discapacidad',
        'padece_enfermedad',
        'enfermedad',
        'toma_medicamentos',
        'medicamentos',
        'afiliado_sgsss',
        'id_tipo_afiliacion',
        'id_eps',
        'proyecto_profesional',
        'id_cargo',
        'id_escolaridad_nivel',
        'id_estado_escolaridad'];

}
