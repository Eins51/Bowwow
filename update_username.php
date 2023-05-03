<?php
require_once 'include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = intval($_POST['admin_id']);
    $username = trim($_POST['username']);

    $sql = "UPDATE admin SET username=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $username, $admin_id);

    if ($stmt->execute()) {
        echo "Username updated successfully";
    } else {
        echo "Error updating username";
    }
}
?>
