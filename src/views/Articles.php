<?php
// include __DIR__.'/../config/connection.php';
include __DIR__.'/../controler/articles.php';
$articles = Article::getAllArticlesWithDetails();
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
                        <span class="title">Yassine aghla</span>
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

                <li>
                    <a href="Articles.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Articles</span>
                    </a>
                </li>

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
                    <a href="../includes/nationalite.php">
                        <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">Auteur</span>
                    </a>
                </li>

                <li>
                    <a href="#">
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
  <!-- =============== formualire ================ -->

  <div class="form-container">
        <h2>Ajouter un article</h2>
        <form action="../controler/articles.php" method="POST">

            
            <div>
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required>
            </div>
             <div>
                <label for="content">Contenu</label>
                <textarea id="content" name="content" rows="4" required></textarea>
            </div>
            <div>
                <label for="excerpt">Extrait</label>
                <textarea id="excerpt" name="excerpt" rows="3"></textarea>
            </div>
             <div>
                <label for="meta_description">Meta Description</label>
                <input type="text" id="meta_description" name="meta_description">
            </div>
            <div>
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" required>
                    <option value="" disabled selected>Choisir une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="tags-container">
                <label style="color: black;">Tags</label>
                <?php foreach ($tags as $tag): ?>
                    <div>
                        <input type="checkbox" id="tag_<?= $tag['id'] ?>" name="tags[]" value="<?= $tag['id'] ?>">
                        <label for="tag_<?= $tag['id'] ?>"><?= htmlspecialchars($tag['name']) ?></label>
                    </div>
                <?php endforeach; ?>
                </div>
            <div>
                <label for="featured_image">Image en vedette</label>
                <input type="url" id="featured_image" name="featured_image">
            </div>

            <div>
                <label for="status">Statut</label>
                <select id="status" name="status" required>
                    <option value="draft" selected>Draft</option>
                    <option value="published">Publié</option>
                    <option value="scheduled">Programmé</option>
                </select>
            </div>

            
            <div>
                <label for="scheduled_date">Date de programmation</label>
                <input type="datetime-local" id="scheduled_date" name="scheduled_date">
            </div>

            
            <button type="submit" name="submit">Soumettre</button>

        </form>
    </div>

  <h1>Liste des Articles</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Extrait</th>
                <th>Statut</th>
                <th>Date de Programmation</th>
                <th>Catégorie</th>
                <th>Auteur</th>
                <th>Date de Création</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['id']) ?></td>
                        <td><?= htmlspecialchars($article['title']) ?></td>
                        <td><?= htmlspecialchars($article['excerpt']) ?></td>
                        <td><?= htmlspecialchars($article['status']) ?></td>
                        <td><?= htmlspecialchars($article['scheduled_date'] ?: 'Non programmé') ?></td>
                        <td><?= htmlspecialchars($article['category_name']) ?></td>
                        <td><?= htmlspecialchars($article['author_name']) ?></td>
                        <td><?= htmlspecialchars($article['created_at']) ?></td>
                        <td>
                            <?php if ($article['featured_image']): ?>
                                <img src="<?= htmlspecialchars($article['featured_image']) ?>" alt="Image" style="width: 60px; height: auto;">
                            <?php else: ?>
                                Aucune image
                            <?php endif; ?>

                        </td>
                        <td><?= htmlspecialchars($article['tag_names'] ?: 'Aucun tag') ?></td>
                        <td>
                            <a href="edit_article.php?id=<?= $article['id'] ?>">Modifier</a> |
                            <a href="delete_article.php?id=<?= $article['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Aucun article trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
