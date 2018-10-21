<?php

class MediaModel extends ArticleModel {
    
    protected $title;
    protected $support;
    protected $image;
    protected $year;
    
    public function __construct($id, $stock, $state, $price, $title, $support, $image, $year) {
        parent::__construct($id, $stock, $state, $price);
        
        $this->title = $title;
        $this->support = $support;
        $this->image = $image;
        $this->year = $year;
    }

    protected function delete() {
        
    }

    protected function insert() {
        
    }

    protected function toCreate() {
        
    }

    protected function toDelete() {
        
    }

    protected function toModify() {
        
    }

    protected function toShow() {
        
    }

    public function toString() {
        $string = "<article class='layout-justify'>";
        $string .= "<div class='col-1 panel'>";
        $string .= "<img class='thumbnail' src='images/medias/" . $this->image . "'>";
        $string .= "</div>";
        $string .= "<div class='col-9 panel'>";
        $string .= "<h3>" . $this->title . "</h3>";
        $string .= "<p>Année de sortie : " . $this->year . "</p>";
        $string .= "<p>Prix : " . $this->price . "€</p>";
        if ($this->support == "Numeric") {
            $string .= "<p class='panel-blue'>Stock illimité</p>";
        }
        else if ($this->stock > 0) {
            $string .= "<p class='panel-green'>" . $this->stock. " articles restants" . "</p>";
        }
        else {
            $string .= "<p class='panel-red'>En rupture de stock</p>";
        }
        $string .= "</div>";
        $string .= "</article>";
        return $string;
    }

    protected function update() {
        
    }
    
    public static function importTitle($id) {
        $title = "Titre inconnu";
        $query = "SELECT title FROM media WHERE id=" . $id;
        
        $statement = dataBaseConnection::execute($query);
        
        if ($statement) {
            $data = $statement->fetchAll();
            
            $title = $data[0]["title"];
        }
        
        return $title;
    }

}