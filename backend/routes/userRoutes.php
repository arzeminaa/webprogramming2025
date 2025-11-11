<?php
require_once __DIR__ . '/../services/UserService.php';
Flight::set('flight.views.path', __DIR__ . '/../views');

    Flight::route('GET /users', function() {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $users = $service->getAllUsers();
        Flight::json($users);
    });

    Flight::route('GET /users/@id', function($id) {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $user = $service->getUserById($id);
        Flight::json($user);
    });

    Flight::route('POST /users', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $newUser = $service->createUser($data);
        Flight::json(['success' => $newUser]);
    });

    Flight::route('PUT /users/@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $updated = $service->updateUser($id, $data);
        Flight::json(['updated' => $updated]);
    });

    Flight::route('DELETE /users/@id', function($id) {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $deleted = $service->deleteUser($id);
        Flight::json(['deleted' => $deleted]);
    });

    Flight::route('POST /users/login', function() {
    $data = Flight::request()->data->getData();
    $conn = Flight::get('db');
    $service = new UserService($conn);

    $user = $service->getUserByEmail($data['email']);

    if ($user && password_verify($data['password'], $user['password'])) {
        Flight::json(['user_id' => $user['user_id']]);
    } else {
        Flight::halt(401, json_encode(['error' => 'Invalid credentials']));
    }
});

    Flight::route('/login', function() {
    Flight::render('login'); // backend/views/login.html
});

Flight::route('/dashboard', function() {
    Flight::render('dashboard'); // backend/views/dashboard.html
});
?>
