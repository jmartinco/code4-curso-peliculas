<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('/update/(:any)','Home::update/$1');
//$routes->get('/update/(:any)/(:num)','Home::update/$1/$2');

$routes->group('dashboard', function ($routes) {
    $routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    //Only testing
    //$routes->get('usuario/create', '\App\Controllers\Web\Usuario::createUser');
    $routes->presenter('categoria', ['controller' => 'Dashboard\Categoria']);
});

$routes->get('login', '\App\Controllers\Web\Usuario::login', ['as' => 'usuario.login']);
$routes->post('login_post', '\App\Controllers\Web\Usuario::login_post', ['as' => 'usuario.login_post']);

$routes->get('register', '\App\Controllers\Web\Usuario::register', ['as' => 'usuario.register']);
$routes->post('register_post', '\App\Controllers\Web\Usuario::register_post', ['as' => 'usuario.register_post']);

$routes->get('logout', '\App\Controllers\Web\Usuario::logout', ['as' => 'usuario.logout']);
