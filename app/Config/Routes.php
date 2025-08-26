<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Rutas: LIBROS
$routes->get('/libros', 'LibroController::index');
$routes->get('/libros/buscar', 'LibroController::buscar');
$routes->post('/public/api/buscarlibro', 'LibroController::buscarLibro');
$routes->get('/libros/crear', 'LibroController::crear'); //Renderiza el FORM
$routes->get('/libros/editar/(:num)', 'LibroController::editar/$1');
$routes->post('/libros/guardar', 'LibroController::guardar'); //<form method="POST">
$routes->post('/libros/actualizar', 'LibroController::actualizar'); 
$routes->get('/libros/borrar/(:num)', 'LibroController::borrar/$1');

$routes->get('/editoriales', 'EditorialController::index');
$routes->get('/editoriales/crear', 'EditorialController::crear');
$routes->get('/editoriales/editar', 'EditorialController::editar');
