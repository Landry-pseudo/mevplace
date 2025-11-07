<?php
use CodeIgniter\Router\RouteCollection;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->options('api/(:any)', function() {
    return service('response')->setStatusCode(200);
});


$routes->post('api/auth/login', 'Api\Auth::login', ['filter' => 'cors']);

$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'cors'], function($routes) {
    // Authentification
    $routes->post('register', 'Auth::register');
    // $routes->post('auth/login', 'Auth::login');
    $routes->post('logout', 'Auth::logout');
    $routes->get('check-auth', 'Auth::checkAuth');
    
    $routes->get('install/user', 'Install::createDefaultUser');
    // Produits
    $routes->get('products', 'Products::index');
    $routes->get('products/(:num)', 'Products::show/$1');
    $routes->get('products/category/(:any)', 'Products::byCategory/$1');
    
    // Routes protégées
    $routes->group('', ['filter' => 'auth'], function($routes) {
        $routes->post('products', 'Products::create');
        $routes->get('dashboard', 'Dashboard::index');
    });
});
// $routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
//     // Authentification
//     $routes->post('register', 'Auth::register');
//     $routes->post('login', 'Auth::login');
//     $routes->post('logout', 'Auth::logout');
//     $routes->get('check-auth', 'Auth::checkAuth');
//     
    
//     // Routes protégées
//     $routes->group('', ['filter' => 'auth'], function($routes) {
//         $routes->get('dashboard', 'Dashboard::index');
//         // Ajouter d'autres routes protégées ici
//     });
// });

// Pour le frontend Vue.js
$routes->get('(:any)', 'Home::index');