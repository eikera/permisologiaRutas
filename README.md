## Rutas-Permisologia

[![Latest Stable Version](https://poser.pugx.org/permisologia/permissionsrolesandroutes/v/stable)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![Total Downloads](https://poser.pugx.org/permisologia/permissionsrolesandroutes/downloads)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![Latest Unstable Version](https://poser.pugx.org/permisologia/permissionsrolesandroutes/v/unstable)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)
[![License](https://poser.pugx.org/permisologia/permissionsrolesandroutes/license)](https://packagist.org/packages/permisologia/permissionsrolesandroutes)


conceder accesos a rutas con permisos / levantar rutas desde mysql

### Note for v1: init

 - Inyectar la rutas desde mysql.
 - Restringir usuarios segun el rol enlazado con la ruta a acceder.
 - Views de permisos y roles.
 - Data de ejemplo como crear las rutas/roles.

## Installation

Require es el paquete de composer. es recomendable usar el require para el uso de este paquete.

```shell
composer require composer require permisologia/permissionsrolesandroutes
```

### Laravel 5.5+:

Si ud no usa auto-discovery, agrega el ServiceProvider dentro del array de providers en config/app.php

```php
permisologia\Permissionsrolesandroutes\App\Providers\PermissionsrolesandroutesProvider::class,
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="GED\Permissionsrolesandroutes\App\Providers\PermissionsrolesandroutesProvider"
```
