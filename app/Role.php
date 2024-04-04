<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Hashids\Hashids;

class Role extends EntrustRole
{
    protected $table = 'roles';
    protected $primarykey = 'id';
    protected $fillable = [
        'name', 'display_name', 'description','tenantId'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
/*
  function getIdAttribute($value)
      {
        
        $hashids = new Hashids('', 10);
        return $hashids->encode($value);

      }*/


}
