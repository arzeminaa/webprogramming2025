<?php
require_once __DIR__ . '/../services/SavingsService.php';

/**
 * @OA\Get(
 *     path="/savings",
 *     summary="Get all savings records",
 *     tags={"Savings"},
 *     @OA\Response(
 *         response=200,
 *         description="List of all savings records"
 *     )
 * )
 */
Flight::route('GET /savings', function() {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $savings = $service->getAllSavings();
    Flight::json($savings);
});

/**
 * @OA\Get(
 *     path="/savings/{user_id}",
 *     summary="Get savings record by user ID",
 *     tags={"Savings"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="ID korisnika",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Savings record of a specific user"
 *     )
 * )
 */
Flight::route('GET /savings/@user_id', function($user_id) {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $saving = $service->getSavingsByUser($user_id);
    Flight::json($saving);
});

/**
 * @OA\Post(
 *     path="/savings",
 *     summary="Create savings data for a user",
 *     tags={"Savings"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "monthly_savings", "yearly_savings"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="monthly_savings", type="number", format="float"),
 *             @OA\Property(property="yearly_savings", type="number", format="float"),
 *             @OA\Property(property="date_recorded", type="string", format="date", nullable=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Savings successfully created"
 *     )
 * )
 */
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

/**
 * @OA\Put(
 *     path="/savings/{user_id}",
 *     summary="Update savings data for a user",
 *     tags={"Savings"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="ID korisnika",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="monthly_savings", type="number", format="float"),
 *             @OA\Property(property="yearly_savings", type="number", format="float"),
 *             @OA\Property(property="date_recorded", type="string", format="date")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Savings data updated"
 *     )
 * )
 */
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

/**
 * @OA\Delete(
 *     path="/savings/{user_id}",
 *     summary="Delete savings data for a user",
 *     tags={"Savings"},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Savings data deleted"
 *     )
 * )
 */
Flight::route('DELETE /savings/@user_id', function($user_id) {
    $conn = Flight::get('db');
    $service = new SavingsService($conn);
    $deleted = $service->deleteSavings($user_id);
    Flight::json(['deleted' => $deleted]);
});

class SavingsGetDocs {}
?>
