<?php
require_once __DIR__ . '/../controler/users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['user_id'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'bio' => $_POST['bio'],
    ];

    $isUpdated = User::updateUser($data);
    if ($isUpdated) {
        header("Location:index.php"); 
    } else {
        echo "Failed to update account.";
    }
}
?>
