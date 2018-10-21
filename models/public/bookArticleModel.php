<?php

class BookArticleModel extends MediaModel {
    
    private $ISBM;
    private $format;
    private $editor;
    private $genders;
    
    public function __construct($id, $stock, $price, $title, $year, $state, $image, $ISBM, $support, $format, $editor, $genders) {
        parent::__construct($id, $stock, $state, $price, $title, $support, $image, $year);
        
        $this->ISBM = $ISBM;
        $this->format = $format;
        $this->editor = $editor;
        $this->genders = $genders;
    }
    
    public function delete() {
        
    }

    public function insert() {
        
    }

    public function toCreate() {
        
    }

    public function toDelete() {
        
    }

    public function toModify() {
        $string = "<article class='layout-justify'>";
        
        $string .= "<div class='col-1 panel'>";
        $string .= "<img class='thumbnail' src='images/medias/" . $this->image . "'>";
        $string .= "</div>";
        
        $string .= "<div class='col-9 panel'>";
        $string .= "<form method='GET'><fieldset><legend>Article Livre n°".$this->id."</legend>";
        $string .= "<input hidden name='page' value='connection'>";
        $string .= "<input hidden name='type' value='books'>";
        $string .= "<input hidden name='crudArticleId' value='" . $this->id . "'>";
        $string .= "Titre: <input name='crudArticleTitle' value=\"".$this->title."\">";
        $string .= "Année de sortie : <input name='crudArticleYear' type='number' value=\"".$this->year."\">";
        $string .= "Prix : <input name='crudArticlePrice' type='number' value=\"".$this->price."\">";
        $string .= "Stock : <input name='crudArticleStock' type='number' value=\"".$this->stock."\">";
        $string .= '<br>';
        $string .= "Image : <input name='crudArticleImage' type='text' value=\"".$this->image."\">";
        $string .= "ISBN : <input name='crudArticleISBN' type='text' value=\"".$this->ISBM."\">";
        
        $string .= "Support : <select name='crudArticleSupport'>";
        $querySupport = "SELECT * FROM supports";
        $statementSupport = dataBaseConnection::execute($querySupport);
        if ($statementSupport) {
            $data = $statementSupport->FetchAll();
            
            for ($i = 0; $i < sizeof($data); $i++) {
                $string .= "<option value='".$data[$i]["id_support"]."'";
                
                if ($this->support == $data[$i]["nom_support"]) {
                    $string .= " selected";
                }
                
                $string .= ">" . $data[$i]["nom_support"] . "</option>";
            }
        }
        $string .= "</select>";
        
        $string .= "Format : <select name='crudArticleFormat'>";
        $queryFormat = "SELECT * FROM format_film";
        $statementFormat = dataBaseConnection::execute($queryFormat);
        if ($statementFormat) {
            $data = $statementFormat->FetchAll();
            
            for ($i = 0; $i < sizeof($data); $i++) {
                $string .= "<option value='".$data[$i]["id_format"]."'";
                
                if ($this->format == $data[$i]["nom_format"]) {
                    $string .= " selected";
                }
                
                $string .= ">" . $data[$i]["nom_format"] . "</option>";
            }
        }
        $string .= "</select>";
        
        $string .= "Editeur : <select name='crudArticleEditor'>";
        $queryRealisateur = "SELECT * FROM edition";
        $statementRealisateur = dataBaseConnection::execute($queryRealisateur);
        if ($statementRealisateur) {
            $data = $statementRealisateur->FetchAll();
            
            for ($i = 0; $i < sizeof($data); $i++) {
                $string .= "<option value='".$data[$i]["id_editeur"]."'";
                
                if ($this->editor == $data[$i]["nom_editeur"]) {
                    $string .= " selected";
                }
                
                $string .= ">" . $data[$i]["nom_editeur"] . "</option>";
            }
        }
        $string .= "</select>";
        
        $string .= "</fieldset>";
        
        $string .= "<input type='submit' value='Sauvegarder les modifications'>";
        $string .= "</form>";
        $string .= "</div>";
        
        $string .= "</article>";
        return $string;
    }

    public function toShow() {
        $string = "";
        
        if ($this->state == "a") {
            $string .= "<article class='layout-justify'>";
            $string .= "<div class='col-1 panel'>";
            $string .= "<img class='thumbnail' src='images/medias/" . $this->image . "'>";
            $string .= "</div>";
            $string .= "<div class='col-8 panel'>";
            $string .= "<h3>" . $this->title . "</h3>";
            $string .= "<p>Année de sortie : " . $this->year . "</p>";
            $string .= "<p>Format : " . $this->format . "</p>";
            $string .= "<p>Editeur : " . $this->editor . "</p>";
            $string .= "<p>Prix : " . $this->price . "€</p>";
            $string .= "<p>Genres : " . $this->genders . "</p>";
            $string .= "<p>Support : " . $this->support . "</p>";
            $string .= "<p>ISBM : " . $this->ISBM . "</p>";

            if ($this->stock == 0) {
                $string .= "<p class='panel-blue'>En cours de réapprovisionnement</p>";
            }
            else {
                $string .= "<p class='panel-green'>" . $this->stock . " articles restants" . "</p>";
            }

            $string .= "</div>";
            $string .= "</article>";
        }
        
        return $string;
    }

    public function toString() {
        
    }

    public function update() {
        $query = "UPDATE media SET title=\"" . $this->title . "\"";
        $query .= ", year=\"" . $this->year . "\"";
        $query .= ", price=\"" . $this->price . "\"";
        $query .= ", stock=\"" . $this->stock . "\"";
        $query .= ", id_support=\"" . $this->support . "\"";
        $query .= ", image=\"" . $this->image . "\"";
        $query .= " WHERE id=\"" . $this->id . "\";";
        
        $query .= "UPDATE media_livre SET id_format_livre=\"" . $this->format . "\"";
        $query .= ", id_editeur=\"" . $this->editor . "\"";
        $query .= ", ISBN=\"" . $this->ISBM . "\"";
        $query .= " WHERE id_media=\"" . $this->id . "\";";
        
        $statement = dataBaseConnection::execute($query);
        return $statement;
    }
    
    public static function import($maxResults, $titleFilter, $priceFilter, $yearFilter) {
        $articlesArray = array();
        
        $query = "SELECT id, title, price, state, year, stock, ISBN, image, nom_support, nom_format, nom_editeur FROM media";
        $query .= " JOIN supports ON supports.id_support = media.id_support";
        $query .= " JOIN media_livre ON media_livre.id_media = media.id";
        $query .= " JOIN format_livre ON format_livre.id_format = media_livre.id_format_livre";
        $query .= " JOIN edition ON edition.id_editeur = media_livre.id_editeur";

        if ($titleFilter) {
            $query .= " WHERE media.title LIKE '%" . $titleFilter . "%'";
        }
        if ($priceFilter) {
            $query .= " WHERE media.price=" . $priceFilter;
        }
        if ($yearFilter) {
            $query .= " WHERE media.year=" . $yearFilter;
        }

        $statement = dataBaseConnection::execute($query);

        if ($statement) {
            $data = $statement->fetchAll();

            $amount = sizeof($data);
            
            if ($maxResults) {
                if ($amount > $maxResults) {
                    $amount = $maxResults;
                }
            }

            for ($i = 0; $i < $amount; $i++) {
                $id = $data[$i]["id"];
                $support = $data[$i]["nom_support"];
                $image = $data[$i]["image"];
                $isbn = $data[$i]["ISBN"];
                $price = $data[$i]["price"];
                $state = $data[$i]["state"];
                $stock = $data[$i]["stock"];
                $title = $data[$i]["title"];
                $year = $data[$i]["year"];
                $format = $data[$i]["nom_format"];
                $editeur = $data[$i]["nom_editeur"];
                $genders = "";

                $query2 = "SELECT id, nom_genre FROM media ";
                $query2 .= "JOIN media_livre_genres ON media_livre_genres.id_media_livre = media.id ";
                $query2 .= "JOIN genres_l ON genres_l.id_genre = media_livre_genres.id_genre_livre";

                $statement2 = dataBaseConnection::execute($query2);

                if ($statement2) {
                    $data2 = $statement2->fetchAll();

                    foreach ($data2 as $gender) {
                        if ($gender["id"] == $id) {
                            $genders .= $gender["nom_genre"] . ", ";
                        }
                    }
                }

                $article = new BookArticleModel($id, $stock, $price, $title, $year, $state, $image, $isbn, $support, $format, $editeur, $genders);
                array_push($articlesArray, $article);
            }
        }
        
        return $articlesArray;
    }

}
