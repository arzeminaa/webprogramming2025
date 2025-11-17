<?php
/**
 * OpenAPI Documentation Generator
 * This script scans all route files and generates OpenAPI documentation
 */

require_once __DIR__ . '/../vendor/autoload.php';

use OpenApi\Generator;

// Define the directories to scan for OpenAPI annotations
$scanDirs = [
    __DIR__ . '/../routes',
    __DIR__ . '/../openapi'
];

// Generate OpenAPI documentation
$openapi = Generator::scan($scanDirs);

// Save as JSON
$jsonPath = __DIR__ . '/openapi.json';
file_put_contents($jsonPath, $openapi->toJson());
echo "OpenAPI JSON generated at: $jsonPath\n";

// Save as YAML
$yamlPath = __DIR__ . '/../../docs/openapi.yaml';
file_put_contents($yamlPath, $openapi->toYaml());
echo "OpenAPI YAML generated at: $yamlPath\n";

echo "\nDocumentation generated successfully!\n";
echo "You can view it at: http://localhost:8001/api-docs\n";