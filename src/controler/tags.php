<?php
//  namespace src\controler; 



require_once __DIR__.'/../model/tag.php';

class tags{




public static function addTag(){

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $tagname=$_POST['tagName'];
    Tag::addtag($tagname);
    
}
if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['tagName'])) {
    $tagId = $_POST['id'];
    $tagName = $_POST['tagName'];
    Tag::updateTag($tagId, $tagName);  // Mettre à jour le tag
    header("Location: tags.php");  // Rediriger après la mise à jour
    exit;
}

// Supprimer un tag
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $tagId = $_GET['id'];
    Tag::deleteTag($tagId);  // Supprimer le tag
    header("Location: tags.php");  // Rediriger après la suppression
    exit;
}

// Afficher les tags
$tags = Tag::getAllTags();  // Récupérer tous les tags



}



public static function displayTags()
{
    $tags = Tag::getAllTags();
    return $tags;
}


public static function getTagCount() {
    return Tag::countTags();
}



// Mettre à jour un tag

// public static function addTag()
// {
//     if (isset($_POST['tag_name'])) {
//         $tagName = $_POST['tag_name'];
//         Tag::addTag($tagName);
//     }// }
// }

}
