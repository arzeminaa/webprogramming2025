<?php
require_once __DIR__ . '/../services/ExpensesService.php';

Flight::group('/expenses', function() {

    /**
     * @OA\Get(
     *     path="/expenses",
     *     summary="Get expenses for a specific user (user_id is required)",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expenses records for the user"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Missing user_id parameter"
     *     )
     * )
     */
    Flight::route('GET /', function() {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);

        if (isset($_GET['user_id'])) {
            Flight::json($service->getExpensesByUser($_GET['user_id']));
        } else {
            Flight::json(["error" => "Missing user_id parameter"]);
        }
    });

    /**
     * @OA\Get(
     *     path="/expenses/{id}",
     *     summary="Get expense by ID",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Expense ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expense record"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Expense not found"
     *     )
     * )
     */
    Flight::route('GET /@id', function($id) {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json($service->getExpenseById($id));
    });

    /**
     * @OA\Post(
     *     path="/expenses",
     *     summary="Create a new expense",
     *     tags={"Expenses"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "amount", "category", "date"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="amount", type="number", format="float"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="description", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A new expense has been created"
     *     )
     * )
     */
    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['success' => $service->createExpense($data)]);
    });

    /**
     * @OA\Put(
     *     path="/expenses/{id}",
     *     summary="Update an existing expense",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Expense ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="number", format="float"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="description", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expense updated successfully"
     *     )
     * )
     */
    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['updated' => $service->updateExpense($id, $data)]);
    });

    /**
     * @OA\Delete(
     *     path="/expenses/{id}",
     *     summary="Delete an expense",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Expense ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Expense deleted successfully"
     *     )
     * )
     */
    Flight::route('DELETE /@id', function($id) {
        $conn = Flight::get('db');
        $service = new ExpensesService($conn);
        Flight::json(['deleted' => $service->deleteExpense($id)]);
    });

});
?>
