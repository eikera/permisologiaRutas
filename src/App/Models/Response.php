<?php

namespace permisologia\Permissionsrolesandroutes\App\Models;

use permisologia\Permissionsrolesandroutes\App\Models\Notificacion;

class Response
{
    private static function guardarAccion($status,$msg,$accion){
      $notificacion = new Notificacion();
      return $notificacion->guardar($status,$msg,$accion);
    }

    public static function status($request, $status = false,$msg = "",$accion = ""){
        $request->session()->flash('status', array('status' => $status,'msg' =>$msg,'accion' =>$accion));
        return self::guardarAccion($status,$msg,$accion);
    }

    public static function statusNoLog($request, $status = false,$msg = "",$accion = ""){
         $request->session()->flash('status', array('status' => $status,'msg' =>$msg,'accion' =>$accion));
         return true;
         
    }

    public static function notify($request, $status = false,$msg = "",$accion = ""){
        $request->session()->flash('notify', array('status' => $status,'msg' =>$msg,'accion' =>$accion));
        return self::guardarAccion($status,$msg,$accion);
    }
}
