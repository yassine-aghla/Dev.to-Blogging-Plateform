
<?php
require __DIR__.'/../controler/tags.php';
// Récupérer le tag à modifier avec l'ID
if (isset($_GET['id'])) {
    $tag = Tag::getTagById($_GET['id']);
    if (!$tag) {
        echo "Tag introuvable";
        exit;
    }
} else {
    echo "ID non spécifié";
    exit;
}
?>

<h2>Modifier le Tag</h2>
<form method="POST" action="tags.php">
    <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
    <label for="tagName">Nom du Tag :</label>
    <input type="text" id="tagName" name="tagName" value="<?php echo $tag['name']; ?>" required>
    <button type="submit" name="update">Enregistrer</button>
</form>
