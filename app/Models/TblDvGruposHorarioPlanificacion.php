<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvGruposHorarioPlanificacion extends Model
{
	protected $table = 'tbl_dv_grupos_horario_planificacion';
	protected $primaryKey = 'id';
	protected $casts = [
	'id_grupo'=>'int',
        'tiempo1'=>'int',
        'tiempo2'=>'int',
        'tiempo3'=>'int',
        'tiempo4'=>'int'
	];

	protected $fillable = [
            'activo',
            'id_grupo',
            'tiempo1',
            'tiempo2',
            'tiempo3',
            'tiempo4',
            'fecha',
            'hora_inicio',
            'hora_fin',
            'eje_tematico',
            'tema',
            'objetivo',
            'juego',
            'habilidades',
            'ejercicios_introductorios',
            'ejercicios_avanzados',//Nuevo
            'juego_evaluativo',//'juego_correctivo',
            'observaciones',
            'juego_correctivo'
	];

}
