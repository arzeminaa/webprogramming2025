<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'vendor/autoload.php';
require 'config/db.php';

Flight::set('db', $conn);

require 'routes/userRoutes.php';

Flight::route('/', function() {
    Flight::render('index');
});

Flight::route('/login', function() {
    $body = Flight::view()->fetch('login');
    Flight::render('layout', ['body' => $body]);
});
Flight::route('/dashboard', function() {
    $body = Flight::view()->fetch('dashboard');
    Flight::render('layout', ['body' => $body]);
});
Flight::route('/register', function() {
    $body = Flight::view()->fetch('register');
    Flight::render('layout', ['body' => $body]);
});
Flight::route('/profile', function() {
    $body = Flight::view()->fetch('profile');
    Flight::render('layout', ['body' => $body]);
});
Flight::route('/settings', function() {
    $body = Flight::view()->fetch('settings');
    Flight::render('layout', ['body' => $body]);
});
Flight::route('/transactions', function() {
    $body = Flight::view()->fetch('transactions');
    Flight::render('layout', ['body' => $body]);
});

Flight::start();
