<?php

use Illuminate\Database\Seeder;
use permisologia\Permissionsrolesandroutes\App\Models\User;
use permisologia\Permissionsrolesandroutes\App\Models\Permiso;
use permisologia\Permissionsrolesandroutes\App\Models\Rol;
use permisologia\Permissionsrolesandroutes\App\Models\RolPermiso;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Por favor espere, actualizando la data...');

        $this->call('rolesSeeder');
        $this->call('usersSeeder');
        $this->call('permisoSeeder');
        $this->call('rolpermisosSeeder');

        $this->command->info('Completada la actualización de la data !');
    }
}


class rolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'descripcion' => 'administrador',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'descripcion' => 'presentador',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'descripcion' => 'gerente',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '4',
                'descripcion' => 'recepcion',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $count = DB::table('rol')->where('descripcion', $row['descripcion'])->count();
            if ($count) {
                if ($count > 1) {
                    $newsId = DB::table('rol')->where('name', $row['name'])
                        ->orderby('id', 'asc')->take(1)->first();
                    DB::table('rol')->where('descripcion', $row['descripcion'])
                        ->where('id', '!=', $newsId->id)->delete();
                }
                continue;
            }
            DB::table('rol')->insert($row);
        }
    }
}

class usersSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('users')->count() == 0) {
            $password = \Hash::make('123456');
            $users = DB::table('users')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => $password,
                'rol_id' => 1
            ]);
        }
    }
}

class permisoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre' => 'permisos',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/permisos',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@index',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'permisosCrear',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/permisos/crear',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@create',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'permisosEditar',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/permisos/editar/{id}',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@edit',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'permisosGuardar',
                'descripcion' => 'permisos',
                'type' => 'post',
                'url' => '/permisos/guardar',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\PermisosController@save',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'rol',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/rol',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\RolController@index',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'rolCrear',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/rol/crear',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\RolController@create',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'rolEditar',
                'descripcion' => 'permisos',
                'type' => 'get',
                'url' => '/rol/editar/{id}',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\RolController@edit',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'rolGuardar',
                'descripcion' => 'permisos',
                'type' => 'post',
                'url' => '/rol/guardar',
                'controller' => 'permisologia\Permissionsrolesandroutes\App\Http\Controllers\RolController@save',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $count = DB::table('permisos')->where('nombre', $row['nombre'])->count();
            if ($count) {
                if ($count > 1) {
                    $newsId = DB::table('permisos')->where('nombre', $row['nombre'])
                        ->orderby('id', 'asc')->take(1)->first();
                    DB::table('permisos')->where('nombre', $row['nombre'])
                        ->where('id', '!=', $newsId->id)->delete();
                }
                continue;
            }
            DB::table('permisos')->insert($row);
        }
    }
}

class rolpermisosSeeder extends Seeder
{
    public function run()
    {
        $users = new User();
        $users = $users::all();

        foreach ($users as $user){
            if($user->rol()->first()->descripcion == "administrador"){
                $rol_id = $user->rol_id;
                $permisos = new Permiso();
                $permisos  = $permisos::where('controller','like','permisos%')->get();

                foreach ($permisos as $permiso){
                    $rol_permiso = new RolPermiso();
                    $rol_permiso->rol_id = $rol_id;
                    $rol_permiso->permisos_id = $permiso->id;
                    $rol_permiso->save();

                }
            }
        }
    }
}