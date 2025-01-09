<?php
require 'connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = Database::getConnection();
    $slug = $_POST['slug'];

    $stmt = $conn->prepare('UPDATE articles SET views = views + 1 WHERE slug = :slug');
    $stmt->bindParam(':slug', $slug);
    $stmt->execute();
    header("Location:/../views/articlesdetails.php?slug=". urlencode($slug));
    exit();

  
}
