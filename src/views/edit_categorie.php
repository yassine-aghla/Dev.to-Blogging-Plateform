<?php
require __DIR__.'/../model/Category.php';

if (isset($_GET['id'])) {
    $category = Category::getCategoryById($_GET['id']);
    if (!$category) {
        echo "Catégorie introuvable";
        exit;
    }
} else {
    echo "ID non spécifié";
    exit;
}
?>

<h2>Modifier la Catégorie</h2>
<form method="POST" action="categories.php">
    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
    <label for="categoryName">Nom de la Catégorie :</label>
    <input type="text" id="categoryName" name="categoryName" value="<?php echo $category['name']; ?>" required>
    <button type="submit" name="update">Enregistrer</button>
</form>
