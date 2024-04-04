<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvEjesTematicos extends Model
{
    protected $table      = 'tbl_dv_ejes_tematicos';
    protected $primarykey = 'id';
    protected $fillable   = ['nombre','observaciones'];

    public function fk_tbl_dv_indicadores()
	{
		return $this->hasMany(\App\Models\TblDvIndicadores::class, 'id_eje');
	}
}
