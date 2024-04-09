<?php

use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
$routes->get('/', 'Home::index');

$routes->get('/home', 'Home::informacio' );

$routes->match(['get', 'post'], 'registre', 'UsuarisController::registre_professor');
$routes->post('/pagina/registre', 'UsuarisController::registre_professor');

$routes->get('/pagina/login', 'UsuarisController::login');
$routes->get('/pagina/TicketProfessors', 'TicketProfessorsController::vista_ticket_profes');


$routes->get('/pagina/TicketSSTT', 'TicketSSTTController::vista_ticket_sstt');

$routes->get('/pagina/TicketAlumnes', 'TicketAlumnesController::vista_layout');
$routes->get('/pagina/alumnes', 'UsuarisController:: alumnes');

$routes->get('/noticia/(:num)', 'UsuarisController::mostrar_numero');
$routes->get('/pagina/(:segment)', 'UsuarisController::mostrar_pagina/$1');
