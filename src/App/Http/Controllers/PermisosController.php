<?php

namespace permisologia\Permissionsrolesandroutes\App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use permisologia\Permissionsrolesandroutes\App\Models\Rol;
use permisologia\Permissionsrolesandroutes\App\Models\Permiso;
use permisologia\Permissionsrolesandroutes\App\Models\Response;

class PermisosController extends Controller
{
    public function index()
    {
        $data['permisos'] = Permiso::all();
        return view('gedpermissionsandroles::permisos.listado',$data);
    }

    public function save(Request $request)
    {
        $permisos = new Permiso();
        $permisos->nombre = $request->nombre;
        $permisos->descripcion = $request->descripcion;
        $permisos->type = $request->type;
        $permisos->url = $request->url;
        $permisos->controller = $request->controller;
        
        
        if($permisos->save()) {
          $msg = "Ruta / Permiso agregada con éxito.";
          Response::status($request,true,$msg);

        }else {
          $msg = "Ocurrio un error al guardar el Ruta / Permiso ";
          Response::status($request,false,$msg);
        }
        return redirect('/permisos');
    }
}
