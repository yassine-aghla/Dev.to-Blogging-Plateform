<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__.'/../config/connection.php';
    $article_id = intval($_POST['article_id']);
    $status = $_POST['status'];
    $allowed_statuses = ['draft', 'published', 'scheduled'];
    if (!in_array($status, $allowed_statuses)) {
        die("Statut invalide");
    }
    $stmt = $pdo->prepare("UPDATE articles SET status = ? WHERE id = ?");
    $stmt->execute([$status, $article_id]);
    header("Location: dashboard.php");
    exit();
}
?>
