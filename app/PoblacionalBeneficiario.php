<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoblacionalBeneficiario extends Model
{
    

    protected $table = 'poblacional_beneficiarios';
    protected $primarykey = 'id';
    protected $fillable = ['beneficiario_id', 'grupo_pcs'];

}



