<?php

class User {

    // ATRIBUTS
    private int $_id_User = 0;
    private string $_strCreatedAt = "";
    private string $_strName = "";
    private string $_strRol = "";

    // CONSTRUCTOR  - no tengo claro si hacer count($_arrUsers) desde el Controller y pasarle el argumento id+1 
    public function __construct($id,$name,$rol){
        $this->_id_User = $id;
        $this->_strCreatedAt = date("Y-m-d H:i:s");  // formato "2022-12-31 15:30:54"
        $this->_strName = $name;
        $this->_strRol = $rol;      
    }

    // GETTERS-SETTERS  - de momento como públicos, aunque creo que deberán ser privados
    public function getUserId(){
        return $this->_id_User;
    }
    public function getUserCreatedAt(){
        return $this->_strCreatedAt;
    }
    public function getUserName(){
        return $this->_strName;
    }
    public function setUserName($newName){
        $this->_strName = $newName;
    }
    public function getUserRol(){
        return $this->_strRol;
    }
    public function setUserRol($newRol){
        $this->_strRol = $newRol;
    }

    // METODES
    public function showUser(){
        $strData = "Cod.:" . $this->getUserId();
        $strData .= " | Nombre: " . $this->getUserName();
        $strData .= " | Rol: " . $this->getUserRol();
        $strData .= " | Alta: " . $this->getUserCreatedAt();
        $strData .= " <br> ";
        return $strData;
    }

    public function changeName($newName){
        $this->setUserName($newName);
    }

    public function changeRol($newRol){
        $this->setUserRol($newRol);
    }

}


?>