<?php

class Category {
    private $id_category;
    private $nameCategory;

    public function __construct($id_category, $nameCategory) {
        $this->id_category = $id_category;
        $this->nameCategory = $nameCategory;
    }

    public function getIdCategory() {
        return $this->id_category;
    }

    public function getNameCategory() {
        return $this->nameCategory;
    }

    public function setIdCategory($id_category) {
        $this->id_category = $id_category;
    }

    public function setNameCategory($nameCategory) {
        $this->nameCategory = $nameCategory;
    }
}
