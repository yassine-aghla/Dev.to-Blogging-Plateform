<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
include __DIR__.'/../controler/articles.php';
$articles = array_filter($articles, function ($article) {
    return $article['status'] !== 'draft' ;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogging Platform</title>
    <link rel="stylesheet" href="../../styleFront.css">
    <style>
        
#edit-modal {
    display: none;
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 1000; 
    display: flex;
    justify-content: center;
    align-items: center;
}


#edit-modal form {
    background: #fff; 
    border-radius: 8px;
    width: 100%;
    max-width: 400px;
    padding: 20px; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}


#edit-modal label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    text-align: left;
}


#edit-modal input[type="text"],
#edit-modal input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}


#edit-modal button {
    padding: 10px 20px;
    margin: 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}


#edit-modal button[type="submit"] {
    background-color: #28a745; 
    color: #fff;
    transition: background-color 0.3s ease;
}

#edit-modal button[type="submit"]:hover {
    background-color: #218838; 
}

/* Bouton "Cancel" */
#edit-modal button[type="button"] {
    background-color: #dc3545;
    color: #fff;
    transition: background-color 0.3s ease;
}

#edit-modal button[type="button"]:hover {
    background-color: #c82333;
}

        </style>

</head>
<body>
    <header class="header">
        <h1 class="logo">DEV community</h1>
        <div class="header-buttons">
    <button id="edit-account" class="btn modify">Modifier Account</button>
    <form action="delete_account.php" method="POST" style="display: inline;">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
        <button type="submit" class="btn delete" onclick="return confirmDeletion()">Supprimer Account</button>
    </form>
    <a href="logout.php"> 
        <span class="icon">
            <ion-icon name="log-out-outline"></ion-icon>
        </span>
        <span class="title">Sign Out</span>
    </a>
</div>
 </header>
<div id="edit-modal" style="display: none;">
    <form action="update_account.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo $_SESSION['user']['username']; ?>" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email"  required>
        
        <button type="submit">Save Changes</button>
        <button type="button" id="close-modal">Cancel</button>
    </form>
</div>

    <main class="main-content">
        
        <section class="articles">
            
            <?php foreach ($articles as $article): ?>
    <div class="card">
        <img src="<?= $article['featured_image']; ?>" alt="Article Image" class="card-img">
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($article['title']); ?></h2>
            <p class="card-excerpt"><?= htmlspecialchars($article['excerpt']); ?></p>
            <a href="increment_views.php?slug=<?= urlencode($article['slug']); ?>" class="btn read-more">Read More</a>
        </div>
    </div>
<?php endforeach; ?>
            
        </section>
    </main>
    <script>
        document.getElementById("edit-account").addEventListener("click", () => {
    document.getElementById("edit-modal").style.display = "block";
});

document.getElementById("close-modal").addEventListener("click", () => {
    document.getElementById("edit-modal").style.display = "none";
});
function confirmDeletion() {
    return confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.");
}

        </script>
</body>
</html>
