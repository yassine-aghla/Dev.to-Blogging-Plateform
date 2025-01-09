<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
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
       <!-- =============== Navigation ================ -->
       <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title"><?php echo $_SESSION['user']['username'];?>Yassine aghla</span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <?php if ($role ==='auteur'): ?>
                <li>
                    <a href="Articles.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Articles</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($role==='Admin'): ?>
                <li>
                    <a href="categories.php">
                        <span class="icon">
                           <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categorie</span>
                    </a>
                </li>

                <li>
                    <a href="tags.php">
                        <span class="icon">
                        <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                        <span class="title">Tags</span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">user</span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="sign_up.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
<!-- =============== Main ================ -->
<div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../../assets/me.jpg" alt="">
                </div>
            </div>
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
    <label for="tags">Tags</label>
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
            <label for="scheduled_date">Date de programmation</label>
            <input type="datetime-local" id="scheduled_date" name="scheduled_date" value="<?= htmlspecialchars($article['scheduled_date']) ?>">
        </div>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                </body>
