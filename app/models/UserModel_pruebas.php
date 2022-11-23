<?php

class UserModel {

    // ATRIBUTS
    private int $_id_User = 0;
    private string $_strCreatedAt = "";
    private string $_strName = "";
    private string $_strRol = "";
    private int $_deleted = 0;

    // CONSTRUCTOR  - no tengo claro si hacer count($_arrUsers) desde el Controller y pasarle el argumento id+1 
    public function __construct($id,$name,$rol){
        $this->_id_User = $id;
        $this->_strCreatedAt = date("Y-m-d H:i:s");  // formato "2022-12-31 15:30:54"
        $this->_strName = $name;
        $this->_strRol = $rol;
        $this->_deleted = 0;
    }

    // GETTERS-SETTERS - deberán ser privados
    private function getUserId(){
        return $this->_id_User;
    }
    private function getUserCreatedAt(){
        return $this->_strCreatedAt;
    }
    private function getUserName(){
        return $this->_strName;
    }
    private function setUserName($newName){
        $this->_strName = $newName;
    }
    private function getUserRol(){
        return $this->_strRol;
    }
    private function setUserRol($newRol){
        $this->_strRol = $newRol;
    }

    private function setDeleted($status){
        $this->_deleted = $status;
    }

    // METODES
    public function showById_MySql($table, $id){
        $criteria = 'id=' . $id;
        $consulta = "SELECT * FROM " . $table . " WHERE " . $criteria;
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

    // métodos abstractos (vacíos) que obligará a la subclase a implementarlos:  saveJSON($data), saveMSQL($data), saveMongo($data)
    // public function save($data){

    // }


    // implementamos aquí el MOSTRAR all:
    // Mostrem el JSON tal qual tipus TXT:
    public function showAll($tabla,$criterio){

        $data_users = file_get_contents("../db/users.json");
        $json_users = json_decode($data_users, true);
        echo "ID &nbsp; NAME &nbsp; ROL <br>";
        echo "------------------- <br>";
        foreach ($json_users as $register){
            foreach ($register as $field) {    
                echo $field." - ";
            }
            echo "<br>";
        }
    }

    // implementamos aquí el MOSTRAR byId:
    public function showById($tabla,$criterio){
        $select = "SELECT * FROM " .$tabla. " WHERE " .$criterio. ";";
        $result = $this->db->query($select);
        while ($filas=$result->FETCHALL(PDO::FETCH_ASSOC)) {
            $this->personas[]=$filas;
        }
        return $this->personas;
    }

    // implementamos aquí el SAVE a MySql:
    public function saveMySql($table,$data){
        $insert = "insert into " . $table . " values(null,".$data.")";
        $result = $this->db->query($insert);
        if ($result) return true; else return false;
    }

    // implementamos aquí el SAVE a JSON:
    public function save($data){
        // cambia el ESTADO de los Atributos, pero es VOLATIL
        $this->setUserName($data['nom']);
        $this->setUserRol($data['rol']);
        // cambia en FICHERO su contenido, PERSISTENCIA de datos
        json_encode($data);
        file_put_contents("../db/users.json",$data);
    }

    // implementamos aquí el DELETE a JSON (un recycle nos permite recuperarlo, todavia no Delete total)
    public function recycle($data,$status){
        // cambia el ESTADO de los Atributos, pero es VOLATIL
        $this->setDeleted($status);        
        // cambia en FICHERO su contenido, PERSISTENCIA de datos
        json_encode($data);
        file_put_contents("../db/users.json",$data);
    }

    public function delete($data){
        return true;
    }

}

?>