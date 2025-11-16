<?php
require_once __DIR__ . '/../services/CategoryService.php';

/**
 * @OA\Tag(
 *     name="Categories",
 *     description="API endpoints for categories"
 * )
 */
class CategoryDocs {

    /**
     * @OA\Get(
     *     path="/categories",
     *     summary="Get all categories",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all categories"
     *     )
     * )
     */
    public function getAll() {}

    /**
     * @OA\Get(
     *     path="/categories/{id}",
     *     summary="Get category by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category by ID"
     *     )
     * )
     */
    public function getById() {}

    /**
     * @OA\Post(
     *     path="/categories",
     *     summary="Create a new category",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A new category has been created"
     *     )
     * )
     */
    public function create() {}

    /**
     * @OA\Put(
     *     path="/categories/{id}",
     *     summary="Update category by ID",
     *     tags={"Categories"},
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
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated"
     *     )
     * )
     */
    public function update() {}

    /**
     * @OA\Delete(
     *     path="/categories/{id}",
     *     summary="Delete category by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted"
     *     )
     * )
     */
    public function delete() {}
}

// --- Actual routes remain the same ---

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
