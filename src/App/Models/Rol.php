<?php

namespace permisologia\Permissionsrolesandroutes\App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rol";


    public function users()
    {
        return $this->hasMany('permisologia\Permissionsrolesandroutes\App\Models\User');
    }

    public function permisos()
    {
        return $this->belongsToMany('permisologia\Permissionsrolesandroutes\App\Models\Permiso', 'rol_permisos', 'rol_id', 'permisos_id');
    }
}
