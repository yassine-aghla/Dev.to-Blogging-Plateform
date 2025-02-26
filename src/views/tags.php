<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !=='Admin') {
  header('Location: index.php');
  exit();
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
require __DIR__.'/../controler/tags.php';

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
        form {
    display: flex;
    flex-direction: column;
    gap: 15px;

  }
  .form-container{
    width:500px;
    margin:auto;
 margin-bottom:30px;
  }
  form label {
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  form input[type="text"] {
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
    font-size: 16px;
  }
  
  form button {
    background-color:#2a2185;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }
  
  form button:hover {
    background-color:#2a2185;
  }
  
  .table-container {
    margin-top: 20px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table th,
  table td {
    text-align: left;
    padding: 10px;
    border: 1px solid #dddddd;
  }
  
  table th {
    background-color:#2a2185;
    color: white;
  }
  
  table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  table tr:hover {
    background-color: #f1f1f1;
  }
  
  table a {
    color:#2a2185;
    text-decoration: none;
    margin-right: 10px;
    
  }
  
  table a:hover {
    text-decoration: none;
  }
  .delete {
  border: 2px solid red; 
  padding: 5px 10px; 
  border-radius: 5px; 
  color: red; 
  background-color: #ffe6e6; 
  text-decoration: none; 
}

.delete:hover {
  background-color: red;
  color: white; 
}

.update {
  border: 2px solid green; 
  padding: 5px 10px; 
  border-radius: 5px; 
  color: green; 
  background-color: #e6ffe6;
  text-decoration: none; 
}

.update:hover {
  background-color: green;
  color: white; 
}
 

        </style>
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
                        <span class="title"><?php echo $_SESSION['user']['username'];?></span>
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
                <?php if ($role === 'auteur'): ?>
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
                    <a href="articleDash.php">
                        <span class="icon">
                           <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">manage articles</span>
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
                    <img src="../../assets/me.jpg" alt="">
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
           
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    echo "<tr>
                            <td>{$tag['id']}</td>
                            <td>{$tag['name']}</td>
                            <td>
                                <a class='update' href='edit_tag.php?id={$tag['id']}'>Modifier</a>
                                 <a class='delete' href='tags.php?action=delete&id={$tag['id']}'>Supprimer</a>
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
