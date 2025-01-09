<?php
require_once __DIR__.'/../config/connection.php';

class User {
    private static $table = 'users';

    public static function createUser($data) {
        if (!isset($data['role'])) {
            $data['role'] = 'user'; 
        }
        $conn = Database::getConnection();
        $query = "INSERT INTO " . self::$table . " (username, email, password_hash, bio, role) 
                  VALUES (:username, :email, :password_hash, :bio, :role)";
        $stmt = $conn->prepare($query); 
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            ':bio' => $data['bio'],
            ':role' => $data['role']
        ]);
    }
    public static function findUserByEmail($email) {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table . " WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getAllUsers() {
        $conn = Database::getConnection();
        $query = "SELECT * FROM " . self::$table;
        $stmt = $conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateRole($userId, $newRole) {
        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " SET role = :role WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':role' => $newRole,
            ':id' => $userId
        ]);
    }
    
    public static function banUser($userId) {
        $conn = Database::getConnection();
        $query = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute([':id' => $userId]);
    }
    public static function updateUser($data) {
        $conn = Database::getConnection();
        $query = "UPDATE " . self::$table . " 
                  SET username = :username, email = :email
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':bio' => $data['bio'],
            ':id' => $data['id']
        ]);
    }
    public static function getUsersCount() {
        $conn = Database::getConnection();
        $query = "SELECT COUNT(*) AS count FROM " . self::$table;
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    public static function getUserStats($userId) {
        $conn = Database::getConnection();
        $query = "SELECT COUNT(articles.id) AS article_count, SUM(articles.views) AS total_views 
                  FROM articles 
                  WHERE articles.author_id = :author_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([':author_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
