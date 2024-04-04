<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenEstadoCivil extends Model
{

    protected $table      = 'tbl_gen_estado_civil';
    protected $primarykey = 'id';
    protected $fillable   = ['descripcion'];
}
