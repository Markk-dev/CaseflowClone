<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication 
$routes->get('/', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registerUser');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginUser');

// Dashboard 
$routes->get('dashboard', 'Dashboard::index');
$routes->get('cases/create', 'Dashboard::createCasePage'); 
$routes->post('cases/create', 'Dashboard::createCase');   
$routes->post('cases/edit/(:num)', 'Dashboard::editCase/$1');
$routes->post('cases/delete/(:num)', 'Dashboard::deleteCase/$1');

$routes->get('user/getUserData', 'UserController::getUserData');

//Edit 
$routes->get('cases/edit/(:num)', 'ConfigController::edit/$1');
$routes->post('cases/edit/(:num)', 'ConfigController::update/$1'); 

//Delete 
$routes->delete('cases/delete/(:num)', 'Dashboard::deleteCase/$1');

// Statistics
$routes->get('statistics', 'StatisticsController::index');
$routes->get('api/case-data', 'StatisticsController::getCaseData');

//Complete 
$routes->get('completed', 'CompletedCase::completedCases');






