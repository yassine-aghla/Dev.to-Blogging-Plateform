<?php
// Inclure le fichier de connexion avec le bon chemin relatif

include '../config/connection.php';
class crud {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        return $stmt->execute();
    }

    // READ
    public function select($table, $columns = "*", $conditions = null) {
        $query = "SELECT $columns FROM $table";
        if ($conditions) {
            $query .= " WHERE $conditions";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($table, $data, $conditions) {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fieldsString = implode(", ", $fields);

        $query = "UPDATE $table SET $fieldsString WHERE $conditions";
        $stmt = $this->conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        return $stmt->execute();
    }

    // DELETE
    public function delete($table, $conditions) {
        $query = "DELETE FROM $table WHERE $conditions";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute();
    }
}


// $db = new Database();
// $pdo = $db->getConnection();

// Créer une instance de la classe Tags et utiliser ses méthodes
// $tags = new Tags($pdo);

// // Exemple d'utilisation de la méthode 'insert' pour ajouter un tag
// // $data = ['name' => 'java'];
// // $tags->insert('tags', $data);

// // Exemple d'utilisation de la méthode 'select' pour récupérer tous les tags
// $tagsList = $tags->select('tags');
// echo "<pre>";
// print_r($tagsList);
// echo "</pre>";
// $data = ['name' => 'django'];
// $tags->update('tags',[
//     'name' => 'vue js'
// ], "id = 7");

// $tags->delete('tags',"id = 7");


?>