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

// Include all route files
require 'routes/userRoutes.php';
require 'routes/categoryRoutes.php';
require 'routes/expensesRoutes.php';
require 'routes/incomeRoutes.php';
require 'routes/savingsRoutes.php';
require 'routes/profileRoutes.php';

// OpenAPI documentation endpoint
Flight::route('GET /api-docs', function() {
    $openApiPath = __DIR__ . '/openapi/openapi.json';
    if (file_exists($openApiPath)) {
        header('Content-Type: application/json');
        echo file_get_contents($openApiPath);
    } else {
        Flight::json(['error' => 'OpenAPI documentation not found. Run: php backend/openapi/generate.php'], 404);
    }
});

// Swagger UI endpoint
Flight::route('GET /swagger', function() {
    $swaggerHtml = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - WebProgramming2025</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@5.10.5/swagger-ui.css">
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@5.10.5/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@5.10.5/swagger-ui-standalone-preset.js"></script>
    <script>
        window.onload = function() {
            SwaggerUIBundle({
                url: "/api-docs",
                dom_id: "#swagger-ui",
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout"
            });
        };
    </script>
</body>
</html>';
    echo $swaggerHtml;
});

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
