# Laravel 8
* Crear un proyecto con composer 
* `composer create-project laravel/laravel nombreProy 8.*`
* Ejecutar un proyecto `php artisan serve` el proyecto se mostrara en 8000

## Comandos artisan
* `php artisan route:list -c` ver las rutas de nuestra web 
* `php artisan make:controller nombreControlador` crea un controlador en la carpeta app/controllers
* Crear una migracion `php artisan make:migration create_user_table`
* Para crear un controlador `php artisan make:controller carpeta/nombreControlador`
* Para crear un modelo `php artisan make:model carpeta/modeloNOmbre`
* Limpiar la cache `php artisan cache:clear`, `php artisan config:clear`, `php artisan config:cache`

## Consola de debuggeo
* Usar "barryvdh/laravel-debugbar".
* Deshabilitar `DEBUGBAR_ENABLED=false` en .env

## Ejecucion desde 0
* Requiere **PHP 8.1.6**, para verificar ejecute `php -v` en una terminal
* Una vez con el proyecto ejecutar `composer install`
* Para migrar la base de datos, inicialmente debe crear la base 'hospital' y ponerlo en el arachivo .env
* En este punto debe tener el archivo .env igual al *.env.example* (con todos los datos del servidor *conexion a la base de datos*, *nombre de la base de datos*, etc)
* Después ejecute `php artisan key:generate` para generar la llave de la aplicación.
* Para migrar la estructura de la base de datos ejecutar `php artisan migrate` si siguio los pasos anteriores no debería ocurrir ningun error.
* Para generar el usuario administrador ejecute `php artisan db:seed --class=AdminSeeder`
* Finalmente puede lanzar el servidor con el comando `php artisan serve` que ejecutara el proyecto en el puerto 8000. Si desea ejecutarlo en otro puerto puede usar  `php artisan serve --port=8001`