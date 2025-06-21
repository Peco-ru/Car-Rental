<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::login');
$routes->get('about', 'PagesController::about');

$routes->get('dashboard', 'PagesController::dashboard');
$routes->get('admindashboard', 'PagesController::admin');

$routes->get('login', 'AuthController::login');
$routes->get('login/logout', 'AuthController::logout');
$routes->get('registration', 'AuthController::registration');
$routes->post('registration/store', 'AuthController::store');
$routes->post('authenticate', 'AuthController::authenticate');

$routes->get('admin/userlist', 'PagesController::userlist');

// Cars routes
$routes->get('Ford_Everest', 'PagesController::Ford_Everest');
$routes->get('Nissan_Terra', 'PagesController::Nissan_Terra');
$routes->get('Mitsubishi', 'PagesController::Mitsubishi');
$routes->get('Toyota', 'PagesController::Toyota');

// Admin routes
$routes->get('admin', 'PagesController::admin');
$routes->post('admin/upload-background', 'PagesController::uploadBackground');

// API
$routes->resource('users', ['controller' => 'UserController']);

// File upload routes
$routes->post('pagescontroller/uploadImage', 'PagesController::uploadImage');
$routes->post('ImageController/uploadImage', 'ImageController::uploadImage');

// User list route
$routes->get('userlist', 'PagesController::userlist');

// Serve images
$routes->get('uploads/(:any)', 'ImageController::serveImage/$1');

// Rental submission
$routes->post('rent/submit', 'PagesController::submit');

// Test route
$routes->get('test', function() {
    return "Routing works!";
});
