<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenIdiomas extends Model
{
    protected $table      = 'tbl_gen_idiomas';
    protected $primaryKey = 'id';
    public $timestamps    = false;

	protected $fillable = [
		'descripcion'
	];

}
