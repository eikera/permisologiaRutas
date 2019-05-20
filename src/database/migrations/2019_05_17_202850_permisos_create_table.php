<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermisosCreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('type');
            $table->string('url');
            $table->string('controller');
            $table->timestamps();	
        });
        /*
        DB::table('permisos')->insert(
            array(
                array(
                    'nombre' => 'permisos',
                    'descripcion' => 'Permisos Index Action',
                    'type' => 'get',
                    'url' => '/permisos',
                    'controller' => 'GED\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@index',
                ),
                array(
                    'nombre' => 'permisosCrear',
                    'descripcion' => 'Permisos Crear Action',
                    'type' => 'get',
                    'url' => '/permisos/crear',
                    'controller' => 'GED\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@create',
                ),
                array(
                    'nombre' => 'permisosEditar',
                    'descripcion' => 'Permisos Editar Action',
                    'type' => 'get',
                    'url' => '/permisos/editar/{id}',
                    'controller' => 'GED\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@edit',
                ),
                array(
                    'nombre' => 'permisosGuardar',
                    'descripcion' => 'Permisos Save Action',
                    'type' => 'post',
                    'url' => '/permisos/guardar',
                    'controller' => 'GED\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@save',
                ),               
            )
        );*/
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permisos');
    }
}
