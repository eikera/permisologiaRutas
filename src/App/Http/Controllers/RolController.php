<?php

namespace GED\Permissionsrolesandroutes\App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use GED\Permissionsrolesandroutes\App\Models\Rol;
use GED\Permissionsrolesandroutes\App\Models\Permiso;
use GED\Permissionsrolesandroutes\App\Models\Response;

class RolController extends Controller
{
    public function index()
    {
        $data = array(
            'roles' => Rol::all()
        );
        return view('gedpermissionsandroles::rol.listado',$data);
    }

    public function create()
    {
        $data['roles'] = array();
        $data['permisos'] = Permiso::all();
        return view('gedpermissionsandroles::rol.rol',$data);
    }

    public function edit(Request $request,$id)
    {
        $data = array();
        $rol = Rol::find($id);
        $data['roles'] = $rol;
        $data['permisos'] = Permiso::all();
        $data['permisosrol'] = $rol->permisos()->get();
        return view('gedpermissionsandroles::rol.rol',$data);
    }

    public function save(Request $request)
    {
        $rol = Rol::find($request->id);
        if(!$rol){ 
            $rol = new Rol();
            $rol->descripcion = $request->nombre;
        }else{
            $rol->id = $request->id;
            $rol->descripcion = $request->nombre;
            if($rol->permisos()->detach())
                $rol->permisos()->attach($request->permiso);
        }
        
        if($rol->save()) {
          $msg = "Rol guardado con éxito.";
          Response::status($request,true,$msg);
        }else {
          $msg = "Ocurrio un error al guardar el Rol";
          Response::status($request,false,$msg);
        }
        return redirect('/rol');
    }
}
