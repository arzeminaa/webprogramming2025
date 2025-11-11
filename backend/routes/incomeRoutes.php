<?php
require_once __DIR__ . '/../services/IncomeService.php';

    // GET /income?user_id=1
    Flight::route('GET /income', function() {
        $service = new IncomeService(Flight::get('db'));
        $user_id = Flight::request()->query['user_id'] ?? null;

        if ($user_id) {
            Flight::json($service->getIncomeByUser($user_id));
        } else {
            Flight::json(['error' => 'user_id is required'], 400);
        }
    });

    // GET /income/@id
    Flight::route('GET /income/@id', function($id) {
        $service = new IncomeService(Flight::get('db'));
        Flight::json($service->getIncomeById($id));
    });

    // POST /income
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

    // PUT /income/@id
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

    // DELETE /income/@id
    Flight::route('DELETE /income/@id', function($id) {
        $service = new IncomeService(Flight::get('db'));
        $deleted = $service->deleteIncome($id);
        Flight::json(['deleted' => $deleted]);
    });
