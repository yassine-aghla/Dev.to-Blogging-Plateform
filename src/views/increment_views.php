<?php
include __DIR__.'/../config/connection.php'; 

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $conn = Database::getConnection();
    $stmt = $conn->prepare("UPDATE articles SET views = views + 1 WHERE slug = :slug");
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: articlesdetails.php?slug=" . urlencode($slug));
        exit();
    } else {
        echo "Erreur lors de la mise à jour des vues.";
    }
} else {
    echo "Aucun article spécifié.";
}
?>
