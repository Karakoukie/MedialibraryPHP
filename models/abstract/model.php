<?php

abstract class Model {
    
    protected $id;
    
    protected function __construct($id) {
        $this->id = $id;
    }
    
    protected abstract function toShow();
    protected abstract function toCreate();
    protected abstract function toModify();
    protected abstract function toDelete();
    protected abstract function insert();
    protected abstract function update();
    protected abstract function delete();
    protected abstract function toString();
    
}
