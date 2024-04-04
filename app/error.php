<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class error extends Model
{
    
    protected $table = 'tbl_gen_error';
    protected $primarykey = 'id';
    protected $fillable = ['fecha', 'error'];

}


