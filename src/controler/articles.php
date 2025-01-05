<?php
require_once __DIR__ . '/../config/crudArticle.php';

class ArticlesController {
    public static function handleRequest() {
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'excerpt' => $_POST['excerpt'],
                'meta_description' => $_POST['meta_description'],
                'category_id' => $_POST['category_id'],
                'status' => $_POST['status'],
                'scheduled_date' => $_POST['scheduled_date'],
                'author_id' => 1, 
            ];

            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

          
            $articleId = Article::addArticle($data);

            if ($articleId) {
                
                if (!empty($tags)) {
                    Article::addTags($articleId, $tags);
                }

                header("Location:articles.php?success=true");
                exit;
            } else {
                echo "Erreur lors de l'ajout de l'article.";
            }
        }
    }
    public static function displayArticlesTable() {
        $articles = Article::getAllArticlesWithDetails();
    }
   
    public static function deleteArticle($id) {
         Article::deleteArticle($id);
            }
    
}

ArticlesController::handleRequest();
