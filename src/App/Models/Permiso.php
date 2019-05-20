<?php

namespace GED\Permissionsrolesandroutes\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = "permisos";

    public function roles()
    {
        return $this->belongsToMany('GED\Permissionsrolesandroutes\App\Models\Rol');
    }

}
