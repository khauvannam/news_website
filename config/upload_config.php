<?php
include_once __DIR__ . '/global_config.php';

// Allow any origin to access this resource
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Content-Type: application/json');

// Check if it's an OPTIONS request (CORS preflight) and exit early if so
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$title = !empty($_GET['title']) ? preg_replace('/\s+/', '_', $_GET['title']) : 'default';

if (isset($_FILES['upload']) && is_array($_FILES['upload']['name'])) {
    $urls = [];
    foreach ($_FILES['upload']['name'] as $index => $originalName) {
        if ($_FILES['upload']['error'][$index] === 0) {
            // Folder and filename setup
            $folderName = isset($_POST['name']) ? str_replace(' ', '_', trim($_POST['name'])) : 'default';
            $uploadDir = 'uploads/' . $folderName . '/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            // File with unique timestamp name
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $filename = round(microtime(true) * 1000) . '.' . $extension;
            $targetFilePath = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['upload']['tmp_name'][$index], $targetFilePath)) {
                $urls[] = ['url' => '/' . $targetFilePath];
            } else {
                echo json_encode(['error' => ['message' => 'Failed to move uploaded file.']]);
                exit;
            }
        }
    }
    echo json_encode($urls); // Return array of URLs for all files
} else {
    echo json_encode(['error' => ['message' => 'No files uploaded or upload error occurred.']]);
}
