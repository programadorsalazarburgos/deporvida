<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEquipamentoTipo extends Model
{
	protected $table = 'tbl_dv_equipamento_tipo';
	protected $primaryKey = 'id';
	protected $fillable = ['descripcion'];
}
