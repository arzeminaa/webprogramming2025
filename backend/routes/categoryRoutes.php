<?php
require_once __DIR__ . '/../services/CategoryService.php';

    Flight::route('GET /categories', function() {
        $service = new CategoryService(Flight::get('db'));
        Flight::json($service->getAllCategories());
    });

    Flight::route('GET /categories/@id', function($id) {
        $service = new CategoryService(Flight::get('db'));
        Flight::json($service->getCategoryById($id));
    });

    Flight::route('POST /categories', function() {
        $data = Flight::request()->data->getData();
        $service = new CategoryService(Flight::get('db'));
        $created = $service->createCategory($data);
        Flight::json(['success' => $created]);
    });

    Flight::route('PUT /categories/@id', function($id) {
        $data = Flight::request()->data->getData();
        $service = new CategoryService(Flight::get('db'));
        $updated = $service->updateCategory($id, $data);
        Flight::json(['updated' => $updated]);
    });

    Flight::route('DELETE /categories/@id', function($id) {
        $service = new CategoryService(Flight::get('db'));
        $deleted = $service->deleteCategory($id);
        Flight::json(['deleted' => $deleted]);
    });
