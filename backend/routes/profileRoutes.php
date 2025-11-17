<?php
require_once __DIR__ . '/../services/ProfileService.php';
    
    /**
     * @OA\Get(
     *     path="/profiles",
     *     summary="Get all profiles",
     *     tags={"Profiles"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all profiles"
     *     )
     * )
     */
    Flight::route('GET /profiles', function() {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->getAllProfiles());
    });

    /**
     * @OA\Get(
     *     path="/profiles/{id}",
     *     summary="Get profile by ID",
     *     tags={"Profiles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Profile ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User profile by ID"
     *     )
     * )
     */
    Flight::route('GET /profiles/@id', function($id) {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->getProfileById($id));
    });

    /**
     * @OA\Post(
     *     path="/profiles",
     *     summary="Create new profile",
     *     tags={"Profiles"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="age", type="integer", nullable=true),
     *             @OA\Property(property="bio", type="string", nullable=true),
     *             @OA\Property(property="avatar_url", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile created"
     *     )
     * )
     */
    Flight::route('POST /profiles', function() {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->createProfile($data));
    });

    /**
     * @OA\Put(
     *     path="/profiles/{id}",
     *     summary="Update profile",
     *     tags={"Profiles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Profile ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="age", type="integer", nullable=true),
     *             @OA\Property(property="bio", type="string", nullable=true),
     *             @OA\Property(property="avatar_url", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile updated"
     *     )
     * )
     */
    Flight::route('PUT /profiles/@id', function($id) {
        $data = Flight::request()->data->getData();
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json($service->updateProfile($id, $data));
    });

    /**
     * @OA\Delete(
     *     path="/profiles/{id}",
     *     summary="Delete profile",
     *     tags={"Profiles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Profile ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile deleted"
     *     )
     * )
     */
    Flight::route('DELETE /profiles/@id', function($id) {
        $conn = Flight::get('db');
        $service = new ProfileService($conn);
        Flight::json(['deleted' => $service->deleteProfile($id)]);
    });

    class ProfileGetDocs {}

?>
