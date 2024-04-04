<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplinas extends Model
{

    protected $table = 'tbl_dv_disciplinas';
    protected $primarykey = 'id';
    protected $fillable = ['descripcion','activo'];

}





