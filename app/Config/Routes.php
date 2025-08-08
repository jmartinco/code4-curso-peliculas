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
    $routes->presenter('categoria', ['controller' => 'Dashboard\Categoria']);
});
