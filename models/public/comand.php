<?php

class Comand extends Model {
    
    private $date;
    private $comandLines;
    
    public function __construct($id, $date, $comandLines) {
        parent::__construct($id);
        
        $this->date = $date;
        $this->comandLines = $comandLines;
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

    public function toShow() {
        $string = "<article class='panel-white'>";

        $string .= "<h4>Commande passée le: ".$this->date."</h4>";
        
        $string .= "<table>";
        
        $string .= "<thead>";
        $string .= "<th>Nom du produit</th>";
        $string .= "<th>Quantité</th>";
        $string .= "<th>Prix HT</th>";
        $string .= "<th>Prix TTC</th>";
        $string .= "<th>Total prix TTC</th>";
        $string .= "</thead>";
        
        $totalPriceHT = 0;
        $totalPriceTVA = 0;
        $totalPriceTTC = 0;
        
        for($i=0; $i<sizeof($this->comandLines); $i++) {
            if ($this->comandLines[$i] instanceof ComandLine) {
                $string .= $this->comandLines[$i]->toShow();
                $totalPriceHT += $this->comandLines[$i]->getTotalPriceHT();
                $totalPriceTVA += $this->comandLines[$i]->getTotalPriceTVA();
                $totalPriceTTC += $this->comandLines[$i]->getTotalPriceTTC();
            }
        }
        
        $string .= "</table>";
        
        $string .= "<p>Prix total HT: ". $totalPriceHT ."€</p>";
        $string .= "<p>Montant total TVA: ". $totalPriceTVA ."€</p>";
        $string .= "<p>Prix total TTC: ". $totalPriceTTC ."€</p>";

        $string .= "</article>";
        
        return $string;
    }

    protected function toString() {
        
    }

    protected function update() {
        
    }
    
}
