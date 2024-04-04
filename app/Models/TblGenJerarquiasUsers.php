<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblGenJerarquiasUsers extends Model
{
    protected $table      = 'tbl_gen_jerarquias_users';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'id',
        'id_roles_padre', 
        'id_roles_hijo',
        'tenantId'
    ];
}
