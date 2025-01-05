<?php
require_once __DIR__ . '/../config/crudArticle.php';
require_once __DIR__ . '/../controler/articles.php';
if (!isset($_GET['id'])) {
die('ID darticle non spécifié.');
}

$id = (int) $_GET['id'];
$conn = Database::getConnection();
$query = "SELECT * FROM articles WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$article) {
    die('Article non trouvé.');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../assets/style.css">
    <style>

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin:auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        .tags-container {
            margin-bottom: 10px;
        }

        .tags-container input[type="checkbox"] {
            margin-right: 8px;
            margin-bottom: 10px;
        }
        .tags-container label{
            color:#2a2185;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }

    </style>
    </head>

<body>
<div class="form-container">
    <h2>Modifier l'article</h2>
    <form action="Articles.php?action=update&id=<?= $id ?>" method="POST">
        <div>
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>
        <div>
            <label for="content">Contenu</label>
            <textarea id="content" name="content" rows="4" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>
        <div>
            <label for="excerpt">Extrait</label>
            <textarea id="excerpt" name="excerpt" rows="3"><?= htmlspecialchars($article['excerpt']) ?></textarea>
        </div>
        <div>
            <label for="meta_description">Meta Description</label>
            <input type="text" id="meta_description" name="meta_description" value="<?= htmlspecialchars($article['meta_description']) ?>">
        </div>
        <div>
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id" required>
                <option value="" disabled>Choisir une catégorie</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $article['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
    <label for="tags">Tags</label><br>
    <?php 
    $tags = ArticlesController::getAllTags();
    $articleTags = Article::getTagsForArticle($article['id']); 

    $articleTagIds = array_column($articleTags, 'tag_id');

    foreach ($tags as $tag): 
    ?>
        <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" 
            <?= in_array($tag['id'], $articleTagIds) ? 'checked' : '' ?>> 
        <?= htmlspecialchars($tag['name']) ?><br>
    <?php endforeach; ?>
</div>
        <div>
            <label for="featured_image">Image en vedette</label>
            <input type="url" id="featured_image" name="featured_image" value="<?= htmlspecialchars($article['featured_image']) ?>">
        </div>
        <div>
            <label for="status">Statut</label>
            <select id="status" name="status" required>
                <option value="draft" <?= $article['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= $article['status'] == 'published' ? 'selected' : '' ?>>Publié</option>
                <option value="scheduled" <?= $article['status'] == 'scheduled' ? 'selected' : '' ?>>Programmé</option>
            </select>
        </div>
        <div>
            <label for="scheduled_date">Date de programmation</label>
            <input type="datetime-local" id="scheduled_date" name="scheduled_date" value="<?= htmlspecialchars($article['scheduled_date']) ?>">
        </div>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
</div>
                </body>
