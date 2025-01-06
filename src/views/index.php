<?php

include __DIR__.'/../controler/articles.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogging Platform</title>
    <link rel="stylesheet" href="styleFront.css">

</head>
<body>
    <header class="header">
        <h1 class="logo">DEV community</h1>
        <div class="header-buttons">
            <a href="sign_up.php" class="btn signup">Signup</a>
            <a href="login.php" class="btn login">Login</a>
        </div>
    </header>


    <main class="main-content">
        <section class="articles">
            
            <?php foreach ($articles as $article): ?>
    <div class="card">
        <img src="<?= $article['featured_image']; ?>" alt="Article Image" class="card-img">
        <div class="card-body">
            <h2 class="card-title"><?= htmlspecialchars($article['title']); ?></h2>
            <p class="card-excerpt"><?= htmlspecialchars($article['excerpt']); ?></p>
            <a href="article.php?slug=<?= $article['slug']; ?>" class="btn read-more">Read More</a>
        </div>
    </div>
<?php endforeach; ?>
            
        </section>
    </main>
</body>
</html>
