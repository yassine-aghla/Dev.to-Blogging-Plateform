<?php
require_once __DIR__.'/../config/crud.php';

class Category {
    private static $table = 'categories';
    private static $column = 'name';

    private $nameCategory;

    public function __construct($nameCategory) {
        $this->nameCategory = $nameCategory;
    }

    public function getNameCategory() {
        return $this->nameCategory;
    }

    public function setNameCategory($nameCategory) {
        $this->nameCategory = $nameCategory;
    }

    public static function addCategory($name) {
        return crud::insert(self::$table, ['name' => $name]);
    }

    public static function getAllCategories() {
        return crud::select(self::$table);
    }

    public static function getCategoryById($id) {
        return crud::select(self::$table, '*', "id = $id")[0] ?? null;
    }

    public static function updateCategory($id, $name) {
        return crud::update(self::$table, ['name' => $name], "id = $id");
    }

    public static function deleteCategory($id) {
        return crud::delete(self::$table, "id = $id");
    }
    public static function countCategories() {
        $result = crud::select(self::$table, "COUNT(*) as total");
        return $result[0]['total'] ?? 0;
    }
}
