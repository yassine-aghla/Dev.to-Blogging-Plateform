<?php
require __DIR__.'/connection.php';
class Article {
    private static $table = 'articles';

    public static function addArticle($data) {
        $conn = Database::getConnection();

        try {
            
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));

            
            $query = "INSERT INTO " . self::$table . " 
                (title, content, excerpt, meta_description, category_id, status, scheduled_date, author_id, slug) 
                VALUES 
                (:title, :content, :excerpt, :meta_description, :category_id, :status, :scheduled_date, :author_id, :slug)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':content', $data['content']);
            $stmt->bindParam(':excerpt', $data['excerpt']);
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
    public static function deleteArticle($id) {
    
            $conn = Database::getConnection();
            $query = "DELETE FROM articles WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
        
    }
    
}
