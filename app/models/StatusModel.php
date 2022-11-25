<?php

class Status{
    private $_id;
    private $_description;
    private $_progress;
    private $_active;

    public function getId(){
        return $this->_initiated;
    }
    public function getDescription(){
        return $this->_done;
    }
    public function getProgress(){
        return $this->_initiated;
    }
    public function getActive(){
        return $this->_done;
    }
    public function setId($_id){
        $this->_id= $_id;
    }
    public function setDescription($_description){
        $this->_description= $_description;
    }

    public function setProgress($_progress){
        $this->_progress= $_progress;
    }
    public function setActive($_active){
        $this->_active= $_active;
    }
    

}



?>