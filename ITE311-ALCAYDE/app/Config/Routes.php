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
$routes->get('/forgot', 'Auth::forgot');
$routes->get('/reset', 'Auth::reset');
/**
 * Lab 6
 */
$routes->post('/course/enroll', 'Course::enroll');
$routes->get('/course/enroll', 'Course::studentCourses');
$routes->post('/get/email', 'Auth::getEmail');
$routes->post('/get/code', 'Auth::getCode');
$routes->post('/password/update', 'Auth::changePassword');
$routes->get('/verify_account/(:num)', 'AdminUserController::verifyAccount/$1');
$routes->get('/course/admin', 'Home::courseAdmin');
$routes->post('/course/add/', 'Home::addCourse');
$routes->get('/course/add/', 'Home::addCourse');
$routes->get('/admin/enrollments', 'Home::adminEnroll');
$routes->post('admin/enroll-student', 'Home::enrollStudent');
$routes->get('enrollment/admin/approve/(:num)', 'adminenroll::approve/$1');
$routes->get('enrollment/admin/reject/(:num)', 'adminenroll::reject/$1');
$routes->get('enrollment/admin/unenroll/(:num)', 'adminenroll::unenroll/$1');
$routes->post('/teacher/course/create', 'TeacherCourses::createCourse');
/**
 * lab7
 */
$routes->get('/teacher/course', 'Materials::upload/$1');
$routes->get('/teacher/classes', 'Home::myClasses');
$routes->get('/teacher/addCourse', 'Home::tCourse');
$routes->post('/teacher/course', 'Materials::upload/$1');
$routes->get('/materials/delete/(:num)', 'Materials::delete/$1');
$routes->get('/materials/download/(:num)', 'Materials::download/$1');
$routes->post('/courses/update/(:num)', 'Course::update/$1');
$routes->post('course/enroll/(:num)', 'adminCourse::enroll/$1');
$routes->get('courses/delete/(:num)', 'adminCourse::delete/$1');
$routes->get('/admin/upload', 'Home::courseUpload');





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
