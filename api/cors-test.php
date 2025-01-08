<?php

// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Content type header
header('Content-Type: application/json');

// Simple response for testing
$response = array('message' => 'This is a test to check CORS Origin working');
echo json_encode($response);
?>
