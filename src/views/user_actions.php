<?php
require_once __DIR__.'/../controler/users.php';

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    echo "Access denied.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    if (isset($_POST['action']) && $_POST['action'] === 'ban') {
        $result = User::banUser($userId); 
        header("Location: user.php");
        exit();
    }
    if (isset($_POST['new_role'])) {
        $newRole = $_POST['new_role'];
        $result = User::updateRole($userId, $newRole); 
        header("Location: user.php");
        exit();
    }
}
