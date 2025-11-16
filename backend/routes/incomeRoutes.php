<?php
require_once __DIR__ . '/../services/IncomeService.php';

    // GET /income?user_id=1
    /**
     * @OA\Get(
     *     path="/income",
     *     summary="Get income records for a specific user (user_id is required)",
     *     tags={"Income"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Income records for the user"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="user_id parameter is missing"
     *     )
     * )
     */
    Flight::route('GET /income', function() {
        $service = new IncomeService(Flight::get('db'));
        $user_id = Flight::request()->query['user_id'] ?? null;

        if ($user_id) {
            Flight::json($service->getIncomeByUser($user_id));
        } else {
            Flight::json(['error' => 'user_id is required'], 400);
        }
    });

    /**
     * @OA\Get(
     *     path="/income/{id}",
     *     summary="Get income record by ID",
     *     tags={"Income"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Income record ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Income record"
     *     )
     * )
     */
    Flight::route('GET /income/@id', function($id) {
        $service = new IncomeService(Flight::get('db'));
        Flight::json($service->getIncomeById($id));
    });

    /**
     * @OA\Post(
     *     path="/income",
     *     summary="Create new income record",
     *     tags={"Income"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "amount", "date_received"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="amount", type="number", format="float"),
     *             @OA\Property(property="source", type="string", nullable=true),
     *             @OA\Property(property="date_received", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Income successfully created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error in input"
     *     )
     * )
     */
    Flight::route('POST /income', function() {
        $data = Flight::request()->data->getData();
        $service = new IncomeService(Flight::get('db'));

        try {
            $created = $service->createIncome($data);
            Flight::json(['success' => $created]);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 400);
        }
    });

    /**
     * @OA\Put(
     *     path="/income/{id}",
     *     summary="Update income record",
     *     tags={"Income"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Income record ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="number", format="float"),
     *             @OA\Property(property="source", type="string", nullable=true),
     *             @OA\Property(property="date_received", type="string", format="date")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Income record updated"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error in input"
     *     )
     * )
     */
    Flight::route('PUT /income/@id', function($id) {
        $data = Flight::request()->data->getData();
        $service = new IncomeService(Flight::get('db'));

        try {
            $updated = $service->updateIncome($id, $data);
            Flight::json(['updated' => $updated]);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 400);
        }
    });

    /**
     * @OA\Delete(
     *     path="/income/{id}",
     *     summary="Delete income record",
     *     tags={"Income"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Income record ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Income record deleted"
     *     )
     * )
     */
    Flight::route('DELETE /income/@id', function($id) {
        $service = new IncomeService(Flight::get('db'));
        $deleted = $service->deleteIncome($id);
        Flight::json(['deleted' => $deleted]);
    });
