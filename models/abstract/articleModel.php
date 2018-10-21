<?php

abstract class ArticleModel extends Model {

    protected $stock;
    protected $state;
    protected $price;
    
    protected function __construct($id, $stock, $state, $price) {
        parent::__construct($id);
        
        $this->stock = $stock;
        $this->price = $price;
        $this->state = $state;
    }
    
    public function toBuy($type) {
        $string = "";
        
        if ($this->state == "a" && $this->stock > 0) {
            $string .= "<article class='panel'>";

            $string .= "<form><fieldset><legend>Acheter</legend>";
            
            $string .= "<input hidden name='buyId' value='".$this->id."'>";
            $string .= "<input hidden name='buyType' value='".$type."'>";
            $string .= "<input hidden name='buyPrice' value='".$this->price."'>";
            
            $string .= "Quantité: <select name='buyQuantity'>";
            for($i=1; $i<=$this->stock; $i++) {
                $string .= "<option value='".$i."'>" . $i . "</option>";
            }
            $string .= "</select>";
            
            $string .= "</fieldset>";
            $string .= "<input type='submit' value='Ajouter au panier'>";
            $string .= "</form>";
            $string .= "</article>";
        }
        else {
            $string .= "<article class='panel'>";
            
            $string .= "<p class='info'>Quantité de produits en stock insuffisante pour faire un achat, les délais de réapprovisionnement sont de 1 à 2 semaines, merci de rééssayer ultérieurement.</p>";
            
            $string .= "</article>";
        }
        
        return $string;
    }
    
}
