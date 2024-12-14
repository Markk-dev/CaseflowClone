<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registerUser');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginUser');


$routes->get('dashboard', 'Dashboard::index');


$routes->get('cases/create', 'Dashboard::createOffensePage');  
$routes->post('cases/create', 'Dashboard::createOffense');    


$routes->get('offenses/edit/(:num)', 'Dashboard::editOffensePage/$1');  
$routes->post('offenses/edit/(:num)', 'Dashboard::editOffense/$1');     


$routes->delete('offenses/delete/(:num)', 'Dashboard::deleteOffense/$1');


$routes->get('statistics/getOffenseData', 'StatisticsController::getOffenseData');


$routes->get('statistics', 'StatisticsController::index');
$routes->get('api/case-data', 'StatisticsController::getCaseData');


$routes->get('completed', 'CompletedCase::completedCases');
