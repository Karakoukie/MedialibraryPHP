<?php

class ComandLine extends Model {
    
    private $media;
    private $quantity;
    private $price;
    
    public function __construct($id, $media, $quantity, $price) {
        parent::__construct($id);
        
        $this->media = $media;
        $this->quantity = $quantity;
        $this->price = $price;
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
        $media = MediaModel::importTitle($this->media);
        
        $string = "<tr>";
        
        $string .= "<td>".$media."</td>";
        $string .= "<td>".$this->quantity."</td>";
        $string .= "<td>".$this->price."€</td>";
        $string .= "<td>". ($this->price + $this->price * 0.2) ."€</td>";
        $string .= "<td>". ($this->quantity * ($this->price + $this->price * 0.2)) ."€</td>";
        
        $string .= "</tr>";
        
        return $string;
    }

    protected function toString() {
        
    }

    protected function update() {
        
    }
    
    public function getTotalPriceHT() {
        return $this->quantity * ($this->price);
    }
    
    public function getTotalPriceTVA() {
        return $this->quantity * ($this->price * 0.2);
    }
    
    public function getTotalPriceTTC() {
        return $this->quantity * ($this->price + $this->price * 0.2);
    }

}
