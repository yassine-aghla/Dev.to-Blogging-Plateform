<?php
require_once __DIR__.'/../model/Category.php';

class CategoriesController {

    public static function handleRequest() {
   
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $categoryName = $_POST['categoryName'];
            Category::addCategory($categoryName);
            header("Location: categories.php");
            exit;
        }

       
        if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['categoryName'])) {
            $categoryId = $_POST['id'];
            $categoryName = $_POST['categoryName'];
            Category::updateCategory($categoryId, $categoryName);
            header("Location: categories.php");
            exit;
        }

        
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $categoryId = $_GET['id'];
            Category::deleteCategory($categoryId);
            header("Location: categories.php");
            exit;
        }
    }

    public static function displayCategories() {
        return Category::getAllCategories();
    }
    public static function getCategoryCount() {
        return Category::countCategories();
    }
  
}

CategoriesController::handleRequest();
$categories = CategoriesController::displayCategories();
?>