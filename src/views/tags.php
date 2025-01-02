<?php
require __DIR__.'/../controler/tags.php';
tags::addTag();
$tags =tags::displayTags();
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
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../includes/dashboard.php">
                        <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Yassine aghla</span>
                    </a>
                </li>

                <li>
                    <a href="../includes/dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="../includes/players.php">
                        <span class="icon">
                        <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Articles</span>
                    </a>
                </li>

                <li>
                    <a href="../includes/club.php">
                        <span class="icon">
                           <ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="title">Categorie</span>
                    </a>
                </li>

                <li>
                    <a href="./includes/tags.php">
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

        <!-- ========================= Main ==================== -->
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
                    <img src="../assets/img me.jpg" alt="">
                </div>
            </div>
      <!-- affichage  -->
            <div class="container">
    
            <div class="form-container">
      <form id="tagForm" method="POST">
        <label for="tagName">Nom du Tag :</label>
        <input type="text" id="tagName" name="tagName" placeholder="Entrez un nom de tag" required>
        <button type="submit" name="submit">Ajouter</button>
      </form>
    </div>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id du Tag</th>
                <th>Nom du Tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="tagTableBody">
            <?php
            // Afficher les tags récupérés par le contrôleur
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    echo "<tr>
                            <td>{$tag['id']}</td>
                            <td>{$tag['name']}</td>
                            <td>
                                <a href='edit_tag.php?id={$tag['id']}'>Modifier</a>
                                 <a href='tags.php?action=delete&id={$tag['id']}'>Supprimer</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucun tag trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
  </div>
            
            <script src="dashboard.js"></script>
   

   <!-- ======= Charts JS ====== -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
   <script src="assets/js/chartsJS.js"></script>

   <!-- ====== ionicons ======= -->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>