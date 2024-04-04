<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    public $timestamps = false;
    protected $table = 'permissions';
    protected $primarykey = 'id';
    protected $fillable = ['name', 'display_name', 'description'. 'tenantId'];

}



