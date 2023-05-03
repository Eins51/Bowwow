<?php
session_start();
require_once 'include/config.php';

// Check "admin_id" session variable
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

$admin_id = $_SESSION['admin_id'];

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    $file = $_FILES['avatar'];

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo 'Invalid file type';
        exit;
    }

    // Check file size
    $maxSize = 1024 * 1024 * 2; // 2 MB
    if ($file['size'] > $maxSize) {
        echo 'File size exceeded';
        exit;
    }

    // Save file
    $fileName = uniqid('avatar_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
    $targetPath = 'images/' . $fileName;
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        // Update database with new avatar path
        $sql = "UPDATE admin SET image_path=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $fileName, $admin_id);
        if ($stmt->execute()) {
            // Update session with new avatar path
            $_SESSION['admin_avatar'] = $fileName;
            echo 'File uploaded successfully';
            exit;
        } else {
            echo 'Error updating database';
            exit;
        }
    } else {
        echo 'Error uploading file';
        exit;
    }
} else {
    echo 'No file uploaded';
    exit;
}
