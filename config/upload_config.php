<?php
include_once _DIR . '/global_config.php';

// Allow any origin to access this resource
header("Access-Control-Allow-Origin: ");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Content-Type: application/json');

// Check if it's an OPTIONS request (CORS preflight) and exit early if so
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Get the title from the query string
$title = !empty($GET['title']) ? preg_replace('/\s+/', '', $_GET['title']) : 'default';

// Handle file upload if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload']) && $_FILES['upload']['error'] === 0) {
    $file = $FILES['upload'];
    $uploadDir = _DIR . "/upload/{$title}/"; // Directory based on title
    // Create the directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timestamp = round(microtime(true) 1000);
    $filename = $timestamp . '.' . $extension;
    $targetFilePath = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        $url = BASE_URL . '/news_website/config/upload/' . $title . '/' . $filename;
        echo json_encode(['uploaded' => true, 'url' => $url]);
    } else {
        echo json_encode(['uploaded' => false, 'error' => ['message' => 'Failed to move uploaded file.']]);
    }
} else {
    echo json_encode(['error' => ['message' => 'No file uploaded or upload error occurred.']]);
}