<?php


// Allow any origin to access this resource
header("Access-Control-Allow-Origin: *");

// Set content type to JSON for CKEditor response
header('Content-Type: application/json');

// Check if it's an OPTIONS request (CORS preflight) and exit early if so
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Define the upload directory
$uploadDir = PUBLIC_URL . 'uploads/';

if (isset($_FILES['upload']) && $_FILES['upload']['error'] === 0) {
    $file = $_FILES['upload'];
    $filename = basename($file['name']);
    $targetFilePath = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        $url = '/uploads/' . $filename;
        echo json_encode(['url' => $url]);
    } else {
        echo json_encode(['error' => ['message' => 'Failed to move uploaded file.']]);
    }
} else {
    echo json_encode(['error' => ['message' => 'No file uploaded or upload error occurred.']]);
}

