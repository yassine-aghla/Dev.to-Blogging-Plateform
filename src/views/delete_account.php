<?php
require_once __DIR__ . '/../controler/users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $isDeleted = UsersController::banUser($userId);
    if ($isDeleted) {
        session_start();
        session_destroy();
        header("Location: login.php"); 
    } else {
        echo "Failed to delete account.";
    }
}
?>

