<?php
require_once __DIR__.'/connection.php';
class Article {
    private static $table = 'articles';

    public static function addArticle($data) {
        $conn = Database::getConnection();

        try {
            
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));

            
            $query = "INSERT INTO " . self::$table . " 
                (title, content, excerpt, featured_image,meta_description, category_id, status, scheduled_date, author_id, slug) 
                VALUES 
                (:title, :content, :excerpt, :featured_image, :meta_description, :category_id, :status, :scheduled_date, :author_id, :slug)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':content', $data['content']);
            $stmt->bindParam(':excerpt', $data['excerpt']);
            $stmt->bindParam(':featured_image', $data['featured_image']);
            $stmt->bindParam(':meta_description', $data['meta_description']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':scheduled_date', $data['scheduled_date']);
            $stmt->bindParam(':author_id', $data['author_id']);
            $stmt->bindParam(':slug', $slug);

            $stmt->execute();

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout de l'article : " . $e->getMessage());
        }
    }

    public static function addTags($articleId, $tags) {
        $conn = Database::getConnection();

        try {
            $query = "INSERT INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)";
            $stmt = $conn->prepare($query);

            foreach ($tags as $tagId) {
                $stmt->execute(['article_id' => $articleId, 'tag_id' => $tagId]);
            }

            return true;
        } catch (PDOException $e) {
            die("Erreur lors de l'association des tags : " . $e->getMessage());
        }
    }
    public static function getAllArticlesWithDetails() {
        $conn = Database::getConnection();
        $query = "
            SELECT 
                articles.*,
                categories.name AS category_name,
                users.username AS author_name,GROUP_CONCAT(tags.name SEPARATOR ', ') AS tag_names
            FROM 
                articles
            INNER JOIN 
                categories ON articles.category_id = categories.id
            INNER JOIN 
                users ON articles.author_id = users.id
                LEFT JOIN 
            article_tags ON articles.id = article_tags.article_id
        LEFT JOIN 
            tags ON article_tags.tag_id = tags.id
        GROUP BY 
            articles.id
            ORDER BY 
                articles.created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateArticle($id, $data) {
        $conn = Database::getConnection();
    
        try {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));
    
            $query = "UPDATE " . self::$table . " 
                      SET title = :title, content = :content, excerpt = :excerpt, featured_image = :featured_image, 
                          meta_description = :meta_description, category_id = :category_id, status = :status, 
                          scheduled_date = :scheduled_date, slug = :slug
                      WHERE id = :id";
    
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':content', $data['content']);
            $stmt->bindParam(':excerpt', $data['excerpt']);
            $stmt->bindParam(':featured_image', $data['featured_image']);
            $stmt->bindParam(':meta_description', $data['meta_description']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':scheduled_date', $data['scheduled_date']);
            $stmt->bindParam(':slug', $slug);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de la mise à jour de l'article : " . $e->getMessage());
        }
    }
    public static function deleteArticle($id) {
    
            $conn = Database::getConnection();
            $query = "DELETE FROM articles WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        
    }
    public static function getTagsForArticle($articleId) {
        $conn = Database::getConnection();
        
        $query = "
            SELECT tags.id, tags.name
            FROM tags
            INNER JOIN article_tags ON tags.id = article_tags.tag_id
            WHERE article_tags.article_id = :article_id
        ";
    
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function removeTags($articleId) {
        $conn = Database::getConnection();
        $query = "DELETE FROM article_tags WHERE article_id = :article_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public static function getArticlesCount() {
        $conn = Database::getConnection();
        $query = "SELECT COUNT(*) AS count FROM " . self::$table;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}

