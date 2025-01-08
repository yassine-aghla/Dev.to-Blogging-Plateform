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
                'author_id' => $_SESSION['user']['id'], 
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
                'author_id' => $_SESSION['user']['id'],
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
            public static function getMostReadArticles($limit = 5) {
                $conn = Database::getConnection();
                $query = "SELECT articles.title, articles.slug, articles.views, articles.created_at, users.username 
                          FROM articles 
                          JOIN users ON articles.author_id = users.id
                          ORDER BY articles.views DESC 
                          LIMIT :limit";
                
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->execute();
                
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
                public static function getMostReadArticlesByAuthor($authorId, $limit = 5) {
                    $conn = Database::getConnection();
                    $query = "SELECT articles.title, articles.slug, articles.views, articles.created_at, users.username 
                              FROM articles 
                              JOIN users ON articles.author_id = users.id
                              WHERE articles.author_id = :author_id
                              ORDER BY articles.views DESC 
                              LIMIT :limit";
                    
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
                    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            
                
                public static function getAuthorById($authorId) {
                    $conn = Database::getConnection();
                    $query = "SELECT id, username, bio FROM users WHERE id = :author_id";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
            
            


           
            
    
}

ArticlesController::handleRequest();
$articles = Article::getAllArticlesWithDetails();