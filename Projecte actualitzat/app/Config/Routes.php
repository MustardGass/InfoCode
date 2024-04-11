<?php

use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
$routes->get('/', 'Home::index');

$routes->get('/home', 'Home::informacio' );
//login
$routes->get('/login', 'UsuarisController::login');
$routes->post('/login', 'UsuarisController::login');
$routes->get('/logout', 'UsuarisController::logout');

$routes->get('/pagina_admin', 'UsuarisController::vista_admin');

$routes->get('/registre', 'UsuarisController::registre');
$routes->post('/registre', 'UsuarisController::registre');

$routes->get('/pagina/login', 'UsuarisController::login');
$routes->get('/pagina/TicketProfessors', 'TicketProfessorsController::vista_ticket_profes');


$routes->get('/pagina/TicketSSTT', 'TicketSSTTController::vista_ticket_sstt');

$routes->get('/pagina/TicketAlumnes', 'TicketAlumnesController::vista_layout');
$routes->get('/pagina/alumnes', 'UsuarisController:: alumnes');

$routes->get('/noticia/(:num)', 'UsuarisController::mostrar_numero');
$routes->get('/pagina/(:segment)', 'UsuarisController::mostrar_pagina/$1');
