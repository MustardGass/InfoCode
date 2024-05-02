<?php

use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
$routes->get('/', 'UsuarisController::login');

// $routes->get('/home', 'Home::informacio' );
//login
$routes->get('/login', 'UsuarisController::login');
$routes->post('/login', 'UsuarisController::login');
$routes->get('/logout', 'UsuarisController::logout');

$routes->get('/pagina/login', 'UsuarisController::login');


$routes->get('/pagina_admin', 'UsuarisController::vista_admin');

$routes->get('/registre', 'UsuarisController::registre');
$routes->post('/registre', 'UsuarisController::registre');


$routes->get('/pagina/TicketProfessors', 'TicketProfessorsController::vista_ticket_profes');

//----------CRUD SSTT----------------------
$routes->get('/pagina/TicketSSTT', 'TicketSSTTController::vista_ticket_sstt');

$routes->get('/pagina/afegirTicket', 'TicketSSTTController::afegir_ticket');
$routes->post('/pagina/afegirTicket', 'TicketSSTTController::afegir_ticket');

$routes->get("/pagina/eliminar/(:segment)", 'TicketSSTTController::eliminar_ticket/$1');
$routes->get("/pagina/(:segment)/eliminar", 'TicketSSTTController::delete/$1');

$routes->get('/pagina/editar/(:segment)', 'TicketSSTTController::editar_ticket/$1');
$routes->post('/pagina/editar/(:segment)', 'TicketSSTTController::editar_ticket/$1');

//------------CRUD PROFESSOR-----------------------------
$routes->get('/pagina/TicketProfessors', 'TicketProfessorsController::vista_ticket_profes');

$routes->get('/pagina/TicketAlumnes', 'TicketAlumnesController::vista_layout');
$routes->get('/pagina/alumnes', 'UsuarisController:: alumnes');

$routes->get('/noticia/(:num)', 'UsuarisController::mostrar_numero');
$routes->get('/pagina/(:segment)', 'UsuarisController::mostrar_pagina/$1');