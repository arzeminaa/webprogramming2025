<?php
require_once __DIR__ . '/../services/ProfileService.php';

    Flight::route('GET /profiles', function() {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->getAllProfiles());
    });

    Flight::route('GET /profiles/@id', function($id) {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->getProfileById($id));
    });

    Flight::route('POST /profiles', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->createProfile($data));
    });

    Flight::route('PUT /profiles/@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->updateProfile($id, $data));
    });

    Flight::route('DELETE /profiles/@id', function($id) {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json(['deleted' => $service->deleteProfile($id)]);
    });

?>
