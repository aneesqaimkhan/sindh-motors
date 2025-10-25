<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', 'TestController::index');

// Public showrooms page
$routes->get('showrooms', 'Showrooms::index');
$routes->get('showrooms/members/(:num)', 'Showrooms::members/$1');

// Auth routes
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Auth::dashboard');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('login', 'Auth::adminLogin');
    $routes->post('login', 'Auth::adminLogin');
    
    // Showroom Management Routes
    $routes->get('users', 'Admin::users');
    $routes->get('addShowroom', 'Admin::addShowroom');
    $routes->post('addShowroom', 'Admin::addShowroom');
    $routes->get('editShowroom/(:num)', 'Admin::editShowroom/$1');
    $routes->post('editShowroom/(:num)', 'Admin::editShowroom/$1');
    $routes->get('viewShowroomDetails/(:num)', 'Admin::viewShowroomDetails/$1');
    $routes->get('generateCertificate/(:num)', 'Admin::generateCertificate/$1');
    $routes->get('approveShowroom/(:num)', 'Admin::approveShowroom/$1');
    $routes->get('toggleShowroomStatus/(:num)', 'Admin::toggleShowroomStatus/$1');
    $routes->get('deleteShowroom/(:num)', 'Admin::deleteShowroom/$1');
    
    // Legacy routes (keeping for compatibility)
    $routes->get('addUser', 'Admin::addUser');
    $routes->post('addUser', 'Admin::addUser');
    $routes->get('editUser/(:num)', 'Admin::editUser/$1');
    $routes->post('editUser/(:num)', 'Admin::editUser/$1');
    $routes->get('testEdit/(:num)', 'Admin::testEdit/$1');
    $routes->get('deleteUser/(:num)', 'Admin::deleteUser/$1');
    $routes->get('toggleStatus/(:num)', 'Admin::toggleStatus/$1');
    $routes->get('approve/(:num)', 'Admin::approveUser/$1');
    $routes->get('reject/(:num)', 'Admin::rejectUser/$1');
    $routes->get('user/(:num)', 'Admin::viewUserDetails/$1');
    $routes->get('pending', 'Admin::pendingUsers');
    
    // Membership Management Routes
    $routes->get('getMember/(:num)', 'Admin::getMember/$1');
    $routes->post('addMember', 'Admin::addMember');
    $routes->post('updateMember/(:num)', 'Admin::updateMember/$1');
    $routes->get('toggleMemberStatus/(:num)/(:any)', 'Admin::toggleMemberStatus/$1/$2');
    $routes->get('deleteMember/(:num)', 'Admin::deleteMember/$1');
    $routes->get('generateMemberCard/(:num)', 'Admin::generateMemberCard/$1');
    $routes->get('generateMemberCardFront/(:num)', 'Admin::generateMemberCardFront/$1');
    $routes->get('generateMemberCardBack/(:num)', 'Admin::generateMemberCardBack/$1');
    
    // QR Code Generation
    $routes->get('qrcode/(:num)', 'Admin::generateQrCodeImage/$1');
});

// Members routes
$routes->group('members', function($routes) {
    $routes->get('/', 'Members::index');
    $routes->get('add', 'Members::add');
    $routes->post('add', 'Members::add');
    $routes->get('edit/(:num)', 'Members::edit/$1');
    $routes->post('edit/(:num)', 'Members::edit/$1');
    $routes->get('delete/(:num)', 'Members::delete/$1');
    $routes->get('toggleStatus/(:num)', 'Members::toggleStatus/$1');
    $routes->get('view/(:num)', 'Members::view/$1');
});