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
                    <img src="assets/img me.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Articles</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Users</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Tags</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="pricetag-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">0</div>
                        <div class="cardName">Categories</div>
                    </div>

                    <div class="iconBx">
                    <ion-icon name="grid-outline"></ion-icon>
                        
                    </div>
                </div>
            </div>

            <!-- ================ Add Charts JS ================= -->
            <div class="chartsBx">
                <div class="chart"><canvas id="chart-1"></canvas> </div>
                <div class="chart"> <canvas id="chart-2"></canvas> </div>
            </div>
      <!-- article et auteur -->
      <div class="container">
    <!-- Top Authors Section -->
    <div class="top-authors card">
        <div class="card-header">
            <h2>Top Authors</h2>
        </div>
        <div class="card-body">
            <div class="author">
                <div class="author-profile">
                    <img src="author1.jpg" alt="Author 1">
                </div>
                <div class="author-info">
                    <h3>Author Name</h3>
                    <p>Articles: 25 | Views: 320</p>
                </div>
                <div class="author-actions">
                    <button class="view-profile-btn">View Profile</button>
                </div>
            </div>
            <div class="author">
                <div class="author-profile">
                    <img src="author2.jpg" alt="Author 2">
                </div>
                <div class="author-info">
                    <h3>Author Name</h3>
                    <p>Articles: 30 | Views: 450</p>
                </div>
                <div class="author-actions">
                    <button class="view-profile-btn">View Profile</button>
                </div>
            </div>
            <!-- Add more authors as needed -->
        </div>
    </div>

    <!-- Top Articles Section -->
    <div class="top-articles card">
        <div class="card-header">
            <h2>Most Read Articles</h2>
        </div>
        <div class="card-body">
            <div class="article">
                <div class="article-info">
                    <h3>Article Title</h3>
                    <p>Published on: Jan 1, 2025 by Author Name</p>
                    <p>Views: 1500</p>
                </div>
                <div class="article-actions">
                    <button class="read-article-btn">Read Article</button>
                </div>
            </div>
            <div class="article">
                <div class="article-info">
                    <h3>Article Title</h3>
                    <p>Published on: Dec 25, 2024 by Author Name</p>
                    <p>Views: 1200</p>
                </div>
                <div class="article-actions">
                    <button class="read-article-btn">Read Article</button>
                </div>
            </div>
            <!-- Add more articles as needed -->
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