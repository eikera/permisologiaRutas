<?php

namespace permisologia\Permissionsrolesandroutes\App\Models;
use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\Notifiable;
use \App\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";
    protected $fillable = [
        'id','name', 'email', 'password','rol_id',
    ];
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function hasAccess($permission){
        return $this->rol->permisos()->where('nombre', $permission)->count() > 0;
    }
    
    public function rol()
    {
        return $this->hasOne('permisologia\Permissionsrolesandroutes\App\Models\Rol','id','rol_id');
    }
}
