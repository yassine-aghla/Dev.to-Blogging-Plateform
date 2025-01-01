<?php

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

