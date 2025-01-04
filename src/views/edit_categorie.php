<?php
require __DIR__.'/../model/Category.php';
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
    width:300px;
 

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
  </style>
  <?php
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
    <button type="submit" name="update">Modifier</button>
</form>
