<?php
require_once __DIR__ . '/../services/UserService.php';
Flight::set('flight.views.path', __DIR__ . '/../views');

    /**
    * @OA\Get(
    *     path="/users",
    *     summary="Get all users",
    *     tags={"Users"},
    *     @OA\Response(
    *         response=200,
    *         description="List of users"
    *     )
    * )
    */
    Flight::route('GET /users', function() {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $users = $service->getAllUsers();
        Flight::json($users);
    });

    /**
    * @OA\Get(
    *     path="/users/{id}",
    *     summary="Get user by ID",
    *     tags={"Users"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User by ID"
    *     )
    * )
    */
    Flight::route('GET /users/@id', function($id) {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $user = $service->getUserById($id);
        Flight::json($user);
    });

    /**
    * @OA\Post(
    *     path="/users",
    *     summary="Create a new user",
    *     tags={"Users"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="email", type="string"),
    *             @OA\Property(property="password", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="A new user has been created"
    *     )
    * )
    */
    Flight::route('POST /users', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $newUser = $service->createUser($data);
        Flight::json(['success' => $newUser]);
    });

    /**
    * @OA\Put(
    *     path="/users/{id}",
    *     summary="Update user by ID",
    *     tags={"Users"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=false,
    *         @OA\JsonContent(
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="email", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User updated"
    *     )
    * )
    */
    Flight::route('PUT /users/@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $updated = $service->updateUser($id, $data);
        Flight::json(['updated' => $updated]);
    });

    /**
    * @OA\Delete(
    *     path="/users/{id}",
    *     summary="Delete user by ID",
    *     tags={"Users"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="User deleted"
    *     )
    * )
    */
    Flight::route('DELETE /users/@id', function($id) {
        $conn = Flight::get('db');
        $service = new UserService($conn);
        $deleted = $service->deleteUser($id);
        Flight::json(['deleted' => $deleted]);
    });

    /**
    * @OA\Post(
    *     path="/users/login",
    *     summary="User login",
    *     tags={"Auth"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email", "password"},
    *             @OA\Property(property="email", type="string"),
    *             @OA\Property(property="password", type="string")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Successful login"
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unsuccessful login"
    *     )
    * )
    */
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

class UserGetDocs {}
?>
