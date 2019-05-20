<?php

namespace GED\Permissionsrolesandroutes\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use GED\Permissionsrolesandroutes\App\Models\User;
use GED\Permissionsrolesandroutes\App\Models\Permiso;

class PermissionsrolesandroutesProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @return void
     */

   
     public function register()
    {
        $this->loadViewsFrom(dirname( __DIR__, 2 ).DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."views", 'gedpermissionsandroles');
        $this->loadMigrationsFrom(dirname( __DIR__, 2 ).DIRECTORY_SEPARATOR."database".DIRECTORY_SEPARATOR."migrations");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname( __DIR__, 2 ).DIRECTORY_SEPARATOR."resources".DIRECTORY_SEPARATOR."views" => resource_path('views/vendor/gedpermissionsandroles'),
        ]);

        $this->registerRoutes();
        $this->registerGates();
    }
    public function registerGates(){
        foreach(Permiso::all() as $permiso){
            Gate::define(Str::kebab(Str::lower($permiso->nombre)), function ($user) use($permiso){
                $currentUser = new User($user->getAttributes());
                return $currentUser->hasAccess($permiso->nombre);
            });
        }
    }
    public function registerRoutes(){
        $router = app('router');
        $routes = Permiso::all();
        foreach ($routes as $route){

            $action = [
                "uses" => (Str::contains($route->controller,"\\")) ? $route->controller : "\\App\Http\\Controllers\\".$route->controller,
                "controller" => (Str::contains($route->controller,"\\")) ? explode("@",$route->controller)[0] : "\\App\Http\\Controllers\\".explode("@",$route->controller)[0],
                "as" => $route->nombre
            ];
            switch ($route->type) {
                case "get":
                    $router->get($route->url,$action)->middleware("web")->middleware('can:'.Str::kebab(Str::lower($route->nombre)));
                    break;
                
                case "post":
                    $router->post($route->url,$action)->middleware("web")->middleware('can:'.Str::kebab(Str::lower($route->nombre)));
                    break;

                case "put":
                    $router->put($route->url,$action)->middleware("web")->middleware('can:'.Str::kebab(Str::lower($route->nombre)));
                    break;

                case "patch":
                    $router->patch($route->url,$action)->middleware("web")->middleware('can:'.Str::kebab(Str::lower($route->nombre)));
                    break;

                case "delete":
                    $router->delete($route->url,$action)->middleware("web")->middleware('can:'.Str::kebab(Str::lower($route->nombre)));
                    break;

                default:
                    break;
            }
        }
        return;
    }
}
