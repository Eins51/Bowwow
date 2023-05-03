<?php
session_start();
require_once 'include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = $_SESSION['admin_id'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $password = null;
    if ($_POST['password'] !== '**********') {
        $password = $_POST['password'];
    }

    $query = "UPDATE admin SET gender = '$gender', phone = '$phone', email = '$email'";

    if ($password !== null) {
        $query .= ", password = '$password'";
    }

    $query .= " WHERE id = '$admin_id'";

    if (mysqli_query($con, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
