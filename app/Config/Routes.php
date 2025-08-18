<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('/update/(:any)','Home::update/$1');
//$routes->get('/update/(:any)/(:num)','Home::update/$1/$2');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->resource('pelicula');
    $routes->resource('categoria');
    // Add other API routes here
});

$routes->group('dashboard', function ($routes) {
    $routes->get('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas/$1', ['as' => 'pelicula.etiquetas']);
    $routes->post('pelicula/etiqueta/(:num)', 'Dashboard\Pelicula::etiquetas_post/$1', ['as' => 'pelicula.etiquetas']);

    $routes->post('pelicula/imagen_delete/(:num)', 'Dashboard\Pelicula::borrar_imagen/$1', ['as' => 'pelicula.borrar_imagen']);
    $routes->post('pelicula/imagen_descargar/(:num)', 'Dashboard\Pelicula::descargar_imagen/$1', ['as' => 'pelicula.descargar_imagen']);

    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete', 'Dashboard\Pelicula::etiqueta_delete/$1', ['as' => 'pelicula.etiqueta_delete']);


    $routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    //Only testing
    //$routes->get('usuario/create', '\App\Controllers\Web\Usuario::createUser');
    $routes->presenter('categoria', ['controller' => 'Dashboard\Categoria']);
    $routes->presenter('etiqueta', ['controller' => 'Dashboard\Etiqueta']);
});

$routes->group('blog', function ($routes) {
    //$routes->presenter('', ['controller' => 'Blog\Pelicula', 'only' => ['index', 'show']]);
    $routes->get('', 'Blog\Pelicula::index', ['as' => 'blog.pelicula.index']);
    $routes->get('categorias/(:num)', 'Blog\Pelicula::index_por_categoria/$1', ['as' => 'blog.pelicula.index_por_categoria']);
    $routes->get('etiquetas/(:num)', 'Blog\Pelicula::index_por_etiqueta/$1', ['as' => 'blog.pelicula.index_por_etiqueta']);
    $routes->get('(:num)', 'Blog\Pelicula::show/$1', ['as' => 'blog.pelicula.show']);
    $routes->get('etiquetas_por_categoria/(:num)', 'Blog\Pelicula::etiquetas_por_categoria/$1', ['as' => 'blog.pelicula.etiquetas_por_categoria']);
});

$routes->get('login', '\App\Controllers\Web\Usuario::login', ['as' => 'usuario.login']);
$routes->post('login_post', '\App\Controllers\Web\Usuario::login_post', ['as' => 'usuario.login_post']);

$routes->get('register', '\App\Controllers\Web\Usuario::register', ['as' => 'usuario.register']);
$routes->post('register_post', '\App\Controllers\Web\Usuario::register_post', ['as' => 'usuario.register_post']);

$routes->get('logout', '\App\Controllers\Web\Usuario::logout', ['as' => 'usuario.logout']);

//test
$routes->get('/image/(:any)', 'Dashboard\Pelicula::image/$1', ['as' => 'get_image']);
