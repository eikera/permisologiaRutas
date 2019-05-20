<?php

namespace permisologia\Permissionsrolesandroutes\App\Models;
use \Auth;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = "notificacion";

    public function getUltimasPorUsuario($usuarioId)
    {
        return Notificacion::where('user_id',$usuarioId)->limit(5)->orderBy('id','desc')->get();
    }

    public function getPorUsuarioId($id = false)
    {
        if($id){
            $notificaiones = Notificacion();
        }else {
            $notificaiones = Notificacion::where('user_id',$id)->orderBy('id','desc');
        }
        return $notificaiones;
    }

    public static function guardar($status = false,$msg = "",$accion = "")
    {
      $notificacion = new Notificacion();
      $notificacion->user_id = Auth::user()->id;
      $notificacion->accion = $accion;
      $notificacion->mensaje = $msg;
      $notificacion->estado = $status;
      $notificacion->save();
    }

}
