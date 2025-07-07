<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->group('api', function ($routes) {
  // AUTH
  $routes->post('login', 'AuthController::login');

  // BOOKS
  $routes->get('books', 'BookController::index');
  $routes->get('books/(:num)', 'BookController::show/$1');
  $routes->post('books', 'BookController::create');
  $routes->post('books/(:num)', 'BookController::update/$1');
  $routes->delete('books/(:num)', 'BookController::delete/$1');
});
