<?php
include 'crud.php';
class Tag {
    private $id_tag;
    private $nameTag;

    public function __construct($id_tag, $nameTag) {
        $this->id_tag = $id_tag;
        $this->nameTag = $nameTag;
    }

    public function getIdTag() {
        return $this->id_tag;
    }

    public function getNameTag() {
        return $this->nameTag;
    }

    public function setIdTag($id_tag) {
        $this->id_tag = $id_tag;
    }

    public function setNameTag($nameTag) {
        $this->nameTag = $nameTag;
    }
}

// $tags = new Tags($pdo);

// // Exemple d'utilisation de la méthode 'insert' pour ajouter un tag
$data = ['name' => 'java'];
$tags->insert('tags', $data);

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




