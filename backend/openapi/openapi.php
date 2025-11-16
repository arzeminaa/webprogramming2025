<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="WebProgramming2025 API",
 *         version="1.0.0",
 *         description="Personal Finance Management API - Complete documentation for managing users, categories, expenses, income, savings, and profiles"
 *     ),
 *     @OA\Server(
 *         url="http://localhost:8001",
 *         description="Local Development Server"
 *     ),
 *     @OA\Server(
 *         url="http://localhost:8001/backend",
 *         description="Backend API Server"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="Users",
 *     description="User management endpoints"
 * )
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication endpoints"
 * )
 * @OA\Tag(
 *     name="Categories",
 *     description="Category management endpoints"
 * )
 * @OA\Tag(
 *     name="Expenses",
 *     description="Expense tracking endpoints"
 * )
 * @OA\Tag(
 *     name="Income",
 *     description="Income tracking endpoints"
 * )
 * @OA\Tag(
 *     name="Savings",
 *     description="Savings management endpoints"
 * )
 * @OA\Tag(
 *     name="Profiles",
 *     description="User profile management endpoints"
 * )
 *
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Food"),
 *     @OA\Property(property="description", type="string", example="Food and groceries")
 * )
 *
 * @OA\Schema(
 *     schema="Expense",
 *     type="object",
 *     @OA\Property(property="expense_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="amount", type="number", format="float", example=50.00),
 *     @OA\Property(property="category", type="string", example="Food"),
 *     @OA\Property(property="date", type="string", format="date", example="2025-01-15"),
 *     @OA\Property(property="description", type="string", example="Grocery shopping")
 * )
 *
 * @OA\Schema(
 *     schema="Income",
 *     type="object",
 *     @OA\Property(property="income_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="amount", type="number", format="float", example=2000.00),
 *     @OA\Property(property="source", type="string", example="Salary"),
 *     @OA\Property(property="date_received", type="string", format="date", example="2025-01-01")
 * )
 *
 * @OA\Schema(
 *     schema="Savings",
 *     type="object",
 *     @OA\Property(property="savings_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="monthly_savings", type="number", format="float", example=500.00),
 *     @OA\Property(property="yearly_savings", type="number", format="float", example=6000.00),
 *     @OA\Property(property="date_recorded", type="string", format="date", example="2025-01-01")
 * )
 *
 * @OA\Schema(
 *     schema="Profile",
 *     type="object",
 *     @OA\Property(property="profile_id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="age", type="integer", example=30),
 *     @OA\Property(property="bio", type="string", example="Software developer"),
 *     @OA\Property(property="avatar_url", type="string", example="https://example.com/avatar.jpg")
 * )
 *
 * @OA\Schema(
 *     schema="Error",
 *     type="object",
 *     @OA\Property(property="error", type="string", example="Error message")
 * )
 *
 * @OA\Schema(
 *     schema="Success",
 *     type="object",
 *     @OA\Property(property="success", type="boolean", example=true)
 * )
 */
