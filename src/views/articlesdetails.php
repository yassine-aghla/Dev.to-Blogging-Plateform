<?php
session_start();
require_once __DIR__ . '/../config/crudArticle.php';

// Récupérer le slug depuis l'URL
if (isset($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);
    $article = Article::getArticleBySlug($slug);

    if (!$article) {
        die("Article non trouvé !");
    }
} else {
    die("Slug non fourni !");
}
$role = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f9f9f9;
    color: #333;
}

.article-detail {
    max-width: 800px;
    margin: 2rem auto;
    padding: 1rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.article-img {
    width: 100%;
    border-radius: 8px;
}

.article-title {
    font-size: 2rem;
    margin: 1rem 0;
    color: #222;
}

.article-meta {
    font-size: 0.9rem;
    color: #777;
    margin-bottom: 1.5rem;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.6;
}

.btn {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.6rem 1.2rem;
    background: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.btn:hover {
    background: #0056b3;
}

.back-btn {
    display: block;
    text-align: center;
    margin-top: 2rem;
}
    </style>
</head>
<body>
    <main class="article-detail">
        <article class="article">
            <img src="<?= htmlspecialchars($article['featured_image']); ?>" alt="Image de l'article" class="article-img" height="400" width="auto">
            <h1 class="article-title"><?= htmlspecialchars($article['title']); ?></h1>
            <p class="article-meta">Publié le <?= htmlspecialchars($article['created_at']); ?> par <?= htmlspecialchars($article['author_name']); ?></p>
            <div class="article-content">
                <?= nl2br(htmlspecialchars($article['content'])); ?>
            </div>
        </article>
        <?php if ($role==='Admin'): ?>
            <a href="dashboard.php" class="btn back-btn">Retour</a>
            <?php endif; ?>
            <?php if ($role==='user'): ?>
        <a href="index.php" class="btn back-btn">Retour</a>
        <?php endif; ?>
    </main>
</body>
</html>
