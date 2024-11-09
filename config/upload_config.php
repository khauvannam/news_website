<?php


// Allow any origin to access this resource
header("Access-Control-Allow-Origin: *");

// Set content type to JSON for CKEditor response
header('Content-Type: application/json');


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
