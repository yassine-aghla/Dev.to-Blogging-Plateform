<?php
require_once __DIR__ . '/../config/crudArticle.php';

class ArticlesController {
    public static function handleRequest() {
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'excerpt' => $_POST['excerpt'],
                'featured_image'=> $_POST['featured_image'],
                'meta_description' => $_POST['meta_description'],
                'category_id' => $_POST['category_id'],
                // 'status' => $_POST['status'],
                'scheduled_date' => $_POST['scheduled_date'],
                'author_id' => 1, 
            ];

            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

          
            $articleId = Article::addArticle($data);

            if ($articleId) {
                
                if (!empty($tags)) {
                    Article::addTags($articleId, $tags);
                }

                header("Location: Articles.php");
                exit;
            } else {
                echo "Erreur lors de l'ajout de l'article.";
            }
        }
        if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) $_GET['id'];
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'excerpt' => $_POST['excerpt'],
                'featured_image' => $_POST['featured_image'],
                'meta_description' => $_POST['meta_description'],
                'category_id' => $_POST['category_id'],
                // 'status' => $_POST['status'],
                'scheduled_date' => $_POST['scheduled_date'],
            ];
        
            $success = Article::updateArticle($id, $data);
            if ($success) {
                $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
    
        Article::removeTags($id);
        if (!empty($tags)) {
            Article::addTags($id, $tags);
        }


                header("Location: Articles.php");
                exit;
            } else {
                echo "Erreur lors de la mise à jour de l'article.";
            }
        }
        
    }
    public static function displayArticlesTable() {
        $articles = Article::getAllArticlesWithDetails();
    }
   
    public static function deleteArticle($id) {
         Article::deleteArticle($id);
            }
            public static function getAllTags() {
                $conn = Database::getConnection();
                $query = "SELECT * FROM tags";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            public static function getArticlesCount() {
                return Article::getArticlesCount();
            
            }
            
    
}

ArticlesController::handleRequest();
$articles = Article::getAllArticlesWithDetails();