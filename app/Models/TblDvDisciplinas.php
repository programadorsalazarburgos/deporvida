<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActivosScope;

class TblDvDisciplinas extends Model
{
	protected $table = 'tbl_dv_disciplinas';
	protected $primaryKey = 'id';
	protected $fillable = ['descripcion','activo'];

	protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivosScope);
    }

}
