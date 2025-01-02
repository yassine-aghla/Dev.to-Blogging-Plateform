<?php
// namespace Src\Model;
include __DIR__.'/../config/crud.php';

class Tag {
    private static $table='tags';
    private static $column='name';

    private $nameTag;

    public function __construct($nameTag) {
       
        $this->nameTag = $nameTag;
    }

  

    public function getNameTag() {
        return $this->nameTag;
    }



    public function setNameTag($nameTag) {
        $this->nameTag = $nameTag;
    }

    public static function addTag($name)
    {
        return crud::insert('tags', ['name' => $name]);
    }
    public static function getAllTags()
    {
        return crud::select('tags');
    }
    // public static function deleteTag($id) {
    //     return crud::delete('tags', "id = $id");
    // }
  

// Récupérer un tag par son ID
        public static function getTagById($id) {
            return crud::select('tags', '*', "id = $id")[0] ?? null;
        }
    
        // Mettre à jour un tag
        public static function updateTag($id, $name) {
            return crud::update('tags', ['name' => $name], "id = $id");
        }
        public static function deleteTag($id) {
            return crud::delete('tags', "id = $id");
        }


    // public static function addtag($data){
    //     crud::insert(self::$table,self::$column, $data);
    // }









    // public static function addTag($name) {
    //     $data = ['nameTag' => $name];
    //     return crud::insert('tags', $data);
    // }



}
