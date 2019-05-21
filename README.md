## Rutas-Permisologia

[![Latest Stable Version](https://poser.pugx.org/permisologia/permissionsrolesandroutes/v/stable)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![Total Downloads](https://poser.pugx.org/permisologia/permissionsrolesandroutes/downloads)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![Latest Unstable Version](https://poser.pugx.org/permisologia/permissionsrolesandroutes/v/unstable)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![License](https://poser.pugx.org/permisologia/permissionsrolesandroutes/license)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)


conceder accesos a rutas con permisos / levantar rutas desde mysql

## Instalación

1) Abrir la consola, navegar hasta la raiz de su proyecto

```shell
composer require composer require permisologia/permissionsrolesandroutes
```

2) Agrega el ServiceProvider dentro del array de providers en **config/app.php**.

```php
permisologia\Permissionsrolesandroutes\App\Providers\PermissionsrolesandroutesProvider::class,
```

3) Ejecutar el comando de instalación
```php
$ php artisan permisos:install
```

- default email : admin@admin.com
- default password : 123456


### Note for v1: init

 - Inyectar la rutas desde mysql.
 - Restringir usuarios segun el rol enlazado con la ruta a acceder.
 - Views de permisos y roles.
 - Data de ejemplo como crear las rutas/roles.

### Note for v1.1: Console

 - Comando para generar las rutas/migrations/seeds de manera automática.