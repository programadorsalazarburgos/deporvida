<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEscenarioXEquipamiento extends Model
{
	protected $table = 'tbl_dv_escenario_x_equipamiento';
	protected $primaryKey = 'id';
	protected $casts = [
		'id_escenario' => 'int',
		'id_equipamiento' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'id_escenario',
		'id_equipamiento',
		'cantidad'
	];

}
