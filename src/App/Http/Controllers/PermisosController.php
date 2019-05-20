<?php

namespace GED\Permissionsrolesandroutes\App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use GED\Permissionsrolesandroutes\App\Models\Rol;
use GED\Permissionsrolesandroutes\App\Models\Permiso;
use GED\Permissionsrolesandroutes\App\Models\Response;

class PermisosController extends Controller
{
    public function index()
    {
        $data['permisos'] = Permiso::all();
        return view('permisos.listado',$data);
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
