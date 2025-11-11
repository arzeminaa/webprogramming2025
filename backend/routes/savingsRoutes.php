<?php
require_once __DIR__ . '/../services/SavingsService.php';

Flight::route('GET /savings', function() {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $savings = $service->getAllSavings();
    Flight::json($savings);
});

Flight::route('GET /savings/@user_id', function($user_id) {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $saving = $service->getSavingsByUser($user_id);
    Flight::json($saving);
});

Flight::route('POST /savings', function() {
    $data = Flight::request()->data->getData();
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $created = $service->createSavings(
        $data['user_id'],
        $data['monthly_savings'],
        $data['yearly_savings'],
        $data['date_recorded'] ?? null
    );
    Flight::json(['success' => $created]);
});

Flight::route('PUT /savings/@user_id', function($user_id) {
    $data = Flight::request()->data->getData();
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $updated = $service->updateSavings(
        $user_id,
        $data['monthly_savings'],
        $data['yearly_savings'],
        $data['date_recorded']
    );
    Flight::json(['updated' => $updated]);
});

Flight::route('DELETE /savings/@user_id', function($user_id) {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $deleted = $service->deleteSavings($user_id);
    Flight::json(['deleted' => $deleted]);
});
?>
