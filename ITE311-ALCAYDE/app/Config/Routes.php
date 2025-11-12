<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * Lab 3 ni sya dre
 */
/*
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
*/
/**
 *Lab 4 ni sya dre
 */
$routes->get('/', 'Auth::dashboard');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('users', 'AdminUserController::index');
$routes->post('/users/add', 'AdminUserController::addUser');
$routes->get('/users/add', 'AdminUserController::addUser');
$routes->post('users/update/(:num)', 'AdminUserController::updateUser/$1');
$routes->get('users/toggle/(:num)', 'AdminUserController::toggleRestriction/$1');
$routes->get('restricted/user', 'Home::restricted');
$routes->set404Override('App\Controllers\Home::notFound');
$routes->post('users/changePassword', 'ChangePassword::changePassword');
/**
 * Lab 6
 */
$routes->post('/course/enroll', 'Course::enroll');
$routes->get('/course/enroll', 'Course::studentCourses');
/**
 * for midterm xam
 */
 /**
// Apply the filter to the /admin group
/*$routes->group('admin', ['filter' => 'roleauth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');  // Example route
    // Add more /admin/* routes as needed
});

$routes->group('teacher', ['filter' => 'roleauth:teacher'], function($routes) {
    $routes->get('dashboard', 'Teacher::Dashboard');   // Example route
    // Add more /teacher/* routes as needed
});

$routes->get('announcements', 'Announcement::index');  // Anyone can access this
*/
$routes->get('/announcements', 'Announcement::index');
