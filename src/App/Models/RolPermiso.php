<?php

namespace permisologia\Permissionsrolesandroutes\App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $table = "rol_permisos";

    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol');
    }

    public function permisosDelete($request)
    {
        return RolPermiso::WhereNotIn('permisos_id',$request->permiso)->Where('rol_id',$request->id)->delete();
    }



}
