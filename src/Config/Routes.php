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

$routes->group('paragraphs', ['namespace' => 'Michalsn\CodeIgniterHtmxDemo\Controllers'], static function ($routes) {
    $routes->get('/', 'Paragraphs::index');
    $routes->match(['get', 'post'], 'edit/(:num)', 'Paragraphs::edit/$1');
    $routes->post('reorder', 'Paragraphs::reorder');
});

$routes->group('cells', static function ($routes) {
    $routes->get('/', static function () {
        return view('Michalsn\CodeIgniterHtmxDemo\Views\cells\index');
    });

    $routes->group('counter', static function ($routes) {
        $routes->get('increment', static function () {
            return view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\Counter\CounterCell::increment', service('request')->getGet());
        });

        $routes->get('decrement', static function () {
            return view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\Counter\CounterCell::decrement', service('request')->getGet());
        });
    });

    $routes->get('table-simple', static function () {
        return view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\TableSimple\TableSimpleCell', service('request')->getGet());
    });

    $routes->get('table-advanced', static function () {
        return view_cell('Michalsn\CodeIgniterHtmxDemo\Cells\TableAdvanced\TableAdvancedCell', service('request')->getGet());
    });
});

