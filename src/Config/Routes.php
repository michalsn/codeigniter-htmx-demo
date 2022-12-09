<?php

namespace Michalsn\CodeIgniterHtmxDemo\Config;

$routes->get('demo', static function () {
    return view('Michalsn\CodeIgniterHtmxDemo\Views\home');
});

$routes->group('books', ['namespace' => 'Michalsn\CodeIgniterHtmxDemo\Controllers'], static function ($routes) {
    $routes->get('/', 'Books::index');
    $routes->get('table', 'Books::table');
    $routes->get('show/(:num)', 'Books::show/$1');
    $routes->delete('delete/(:num)', 'Books::delete/$1');
    $routes->match(['get', 'post'], 'edit/(:num)', 'Books::edit/$1');
    $routes->match(['get', 'post'], 'add', 'Books::add');
});

$routes->group('tasks', ['namespace' => 'Michalsn\CodeIgniterHtmxDemo\Controllers'], static function ($routes) {
    $routes->get('/', 'Tasks::index');
    $routes->get('(active|completed)', 'Tasks::index/$1');
    $routes->post('/', 'Tasks::add');
    $routes->put('toggle/(:num)', 'Tasks::toggle/$1');
    $routes->put('toggle-all', 'Tasks::toggleAll');
    $routes->delete('(:num)', 'Tasks::delete/$1');
    $routes->delete('clear-completed', 'Tasks::clearCompleted');
    $routes->get('summary', 'Tasks::summary');
});

