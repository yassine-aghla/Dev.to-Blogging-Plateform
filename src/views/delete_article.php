<?php
require_once __DIR__ . '/../controler/articles.php';
if (isset($_GET['id'])) {
    $articleId = intval($_GET['id']);
    ArticlesController::deleteArticle($articleId);
    header("Location: Articles.php?error=ID de l'article manquant");
} 