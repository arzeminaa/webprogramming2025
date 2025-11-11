<?php
require_once __DIR__ . '/../services/ExpensesService.php';

Flight::group('/expenses', function() {

    // GET all expenses for a specific user
    Flight::route('GET /', function() {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);

        if (isset($_GET['user_id'])) {
            Flight::json($service->getExpensesByUser($_GET['user_id']));
        } else {
            Flight::json(["error" => "Missing user_id parameter"]);
        }
    });

    // GET single expense by ID
    Flight::route('GET /@id', function($id) {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json($service->getExpenseById($id));
    });

    // POST create new expense
    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['success' => $service->createExpense($data)]);
    });

    // PUT update existing expense
    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['updated' => $service->updateExpense($id, $data)]);
    });

    // DELETE expense by ID
    Flight::route('DELETE /@id', function($id) {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['deleted' => $service->deleteExpense($id)]);
    });

});
?>
