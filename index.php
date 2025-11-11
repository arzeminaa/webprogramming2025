<?php
require 'vendor/autoload.php';
require 'config/db.php';

Flight::set('db', $conn);

// API routes
require 'routes/userRoutes.php';

// Serve SPA
Flight::route('/', function() {
    Flight::render('index'); // views/index.php
});

// Serve login and dashboard views
Flight::route('/login', function() {
    Flight::render('login');
});
Flight::route('/dashboard', function() {
    Flight::render('dashboard');
});

Flight::start();
