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

