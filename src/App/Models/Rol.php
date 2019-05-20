<?php

namespace GED\Permissionsrolesandroutes\App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rol";


    public function users()
    {
        return $this->hasMany('GED\Permissionsrolesandroutes\App\Models\User');
    }

    public function permisos()
    {
        return $this->belongsToMany('GED\Permissionsrolesandroutes\App\Models\Permiso', 'rol_permisos', 'rol_id', 'permisos_id');
    }
}
