<?php
require_once __DIR__ . '/../config/crud.php';

class Article {
    private static $table = 'articles';

    
    public static function addArticle($data) {
        $conn = Database::getConnection();

     
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));
        $data['slug'] = $slug;

        
        $inserted = crud::insert(self::$table, $data);

        if ($inserted) {
            return $conn->lastInsertId(); 
        }
        return false;
    }

   
    public static function addTagsToArticle($articleId, $tags) {
        $conn = Database::getConnection();

        foreach ($tags as $tagId) {
            $query = "INSERT INTO article_tags (article_id, tag_id) VALUES (:article_id, :tag_id)";
            $stmt = $conn->prepare($query);
            if (!$stmt->execute(['article_id' => $articleId, 'tag_id' => $tagId])) {
                return false; 
            }
        }
        return true; 
    }
}
