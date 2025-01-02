<?php
// Inclure le fichier de connexion avec le bon chemin relatif

require_once __DIR__.'/connection.php';

class crud {
    private static $conn;

    // public function __construct($pdo) {
    //     self::$conn = $pdo;
    // }


    // public static function insert($table,$columns, $data) {
    //     $conn = Database::getConnection();
    //     //  $db = new Database();
    //     //  $pdo = $db->getConnection();
    //     // $columns = implode(", ", $data);
    //     // $placeholders = ":" . implode(", :", array_keys($data));

    //     $query = "INSERT INTO $table ($columns) VALUES ('$data')";
    //     // var_dump($query);
    //     $stmt = $conn->prepare($query);

    //     // Bind parameters
    //     // foreach ($data as $key => $value) {
    //         // $stmt->bindParam(':data', $data);
    //     // }

    //     return $stmt->execute();
    // }
    public static function insert($table, $data) {
        $conn = Database::getConnection();
        
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }



    // READ
    public static function select($table, $columns = "*", $conditions = null) {
        $conn = Database::getConnection();
         
        $query = "SELECT $columns FROM $table";
        if ($conditions) {
            $query .= " WHERE $conditions";
        }
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function update($table, $data, $conditions) {
        $conn = Database::getConnection();
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fieldsString = implode(", ", $fields);

        $query = "UPDATE $table SET $fieldsString WHERE $conditions";
        $stmt =$conn->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindParam(":$key", $data[$key]);
        }

        return $stmt->execute();
    }

    // DELETE
    public static function delete($table, $conditions) {
        $conn = Database::getConnection();
        $query = "DELETE FROM $table WHERE $conditions";
        $stmt =$conn->prepare($query);

        return $stmt->execute();
    }
}


// $bb= crud::select('tags');
// var_dump($bb);


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