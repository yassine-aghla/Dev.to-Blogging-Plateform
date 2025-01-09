<?php
session_start();


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['user']['role'];
include __DIR__.'/src/controler/articles.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$articles = array_filter($articles, function ($article) use ($search) {
    $isNotDraft = $article['status'] !== 'draft';
    $matchesSearch = empty($search) || stripos($article['title'], $search) !== false;
    return $isNotDraft && $matchesSearch;
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogging Platform</title>
    <link rel="stylesheet" href="styleFront.css">
<style>
    .search form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 100px;
    background-color: #f5f5f5;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}


.search input[type="text"] {
    width: 300px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    transition: border-color 0.3s ease;
}


.search input[type="text"]:focus {
    border-color:#545654;
    outline: none;
}


.search button {
    padding: 10px 20px;
    font-size: 16px;
    background-color:#545654;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}


.search button:hover {
    background-color:#545654;
}
    </style>

</head>
<body>
    <header class="header">
        <h1 class="logo">DEV community</h1>
        <div class="header-buttons">
       
            <a href="src/views/sign_up.php" class="btn signup">Signup</a>
            <a href="src/views/login.php" class="btn login">Login</a>
        </div>
    </header>
    <form method="GET" action="index.php" class="search">
    <input type="text" name="search" placeholder="Rechercher un article par titre" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Rechercher</button>
</form>

    <main class="main-content">
        
        <section class="articles">
            
            <?php foreach ($articles as $article): ?>
    <div class="card">
        <img src="<?= $article['featured_image']; ?>" alt="Article Image" class="card-img" >
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($article['title']); ?></h2>
            <p class="card-excerpt"><?= htmlspecialchars($article['excerpt']); ?></p>
            <a href="src/views/articlesdetails.php?slug=<?= $article['slug']; ?>" class="btn read-more">Read More</a>
        </div>
    </div>
<?php endforeach; ?>
            
        </section>
    </main>
</body>
</html>
