<?php

class UserModel {

    // ATRIBUTS
    private $_jsonFile = "../db/users.json"; 
    public $_fields = array(
        // 'id_user' => '0',
        'strCreatedAt' => '',
        'strName' => '',
        'strRol'  => "",
        'deleted' => '0'
    );

    // utilizar una función existente que ya lo convierte en un Array asociativo automáticamente
    
    // private int $_id_User = 0;
    // private string $_strCreatedAt = "";
    // private string $_strName = "";
    // private string $_strRol = "";
    // private int $_deleted = 0;

    // CONSTRUCTOR  - no tengo claro si hacer count($_arrUsers) desde el Controller y pasarle el argumento id+1 
    public function __construct($path_json_file){
        $this->_jsonFile = $pathJsonFile;
        $this->_fields=array(
            // 'id_user' => getMaxId(),
            'strCreatedAt' => date("Y-m-d H:i:s"),
            'strName' => '',
            'strRol'  => '',
            'deleted' => '0'
        );
        
        // $this->_id_User = $id;
        // $this->_strCreatedAt = date("Y-m-d H:i:s");  // formato "2022-12-31 15:30:54"
        // $this->_strName = $name;
        // $this->_strRol = $rol;
        // $this->_deleted = 0;
    }

    // GETTERS-SETTERS - deberán ser privados
    private function getFields(){
        return $this->_arrFields;
    }

    private function setFields($arrFields){    
        if ($arrFields[0]==0) {
            $arrFields[0] = getMaxId();
        }
        $data = [
            $id_User = $arrFields[0],
            $strCreatedAt = date("Y-m-d H:i:s"),  // formato "2022-12-31 15:30:54"
            $strName = $arrFields[1],
            $strRol = $arrFields[2],           
            $deleted = $arrFields[3],
        ];
        array_push($this->_arrFields,$data);
    }

    // estos ya no los vamos a usar porque ahora tenemos los Atributos dentro de un Array
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
    // métodos abstractos (vacíos) que obligará a la subclase a implementarlos:  saveJSON($data), saveMSQL($data), saveMongo($data)

    // public function show($table, $id, $system['json','mysql','mongo']){
    // }

    // public function save($table, $data, $system['json','mysql','mongo']){
    // }

    // METODES ESPECIFICS de Classe:
    private function getMaxId(){
        $maxId = 0;
        $arrfields = $this->getFields();
        foreach ($arrFields as $field=>$value){
            if ($field == "id_user"){
                if ($maxId < $value){
                    $maxId = $value;
                }
            }
        }        
        return $maxId;

        // TEORIA foreach:
	    // foreach ($_POST as $clave=>$valor){
   		//     echo "El valor de $clave es: $valor";
   		// }        
    }

    // implementamos aquí el MOSTRAR
    public function show($system,$table, $id){

        switch ($system){
            case 'json':
                $jsnUsers = file_get_contents($this->jsonFile);
                $arrUsers = json_decode($jsnUsers, true);                
                
                // return !empty($arrUsers)? $arrUsers : false;

                if ($id==0){
                    return $arrUsers;
                }else{
                    // $singleUser = array_filter($arrUsers, function($obj) { return $ojb->id_user === $id });
                    return $singleUser;
                }

                // echo "ID &nbsp; NAME &nbsp; ROL <br>";
                // echo "------------------- <br>";
                // foreach ($arrUsers as $register){
                //     foreach ($register as $field) {    
                //         if ($register[$field]==$id){ 
                //             echo "Id: " . $field ." - ";
                //             echo "Nom: " . $field . "<br>" ;
                //         }
                //     }
                //     echo "<br>";
                // }
            break;

            case 'mysql':
                // show All
                if ($id==0) {
                    $criteria=' WHERE deleted=0';
                // show ById
                }else{
                    $criteria = ' WHERE deleted=0 AND id=' . $id;
                }
                $consulta = "SELECT * FROM " . $table . $criteria;
                $result = $this->db->query($select);
                while ($filas=$result->FETCHALL(PDO::FETCH_ASSOC)) {
                    $this->users[]=$filas;
                }
                return $this->users;

                // Debugear en pantalla:
                // $strData = "Cod.:" . $this->getUserId();
                // $strData .= " | Nombre: " . $this->getUserName();
                // $strData .= " | Rol: " . $this->getUserRol();
                // $strData .= " | Alta: " . $this->getUserCreatedAt();
                // $strData .= " <br> ";
                // return $strData;
            break;

            case 'mongo':
                // asklñfjasdklñfjkñlsj
            break;
        }
        
        
    }

    // implementamos aquí el SAVE a JSON y MySql:
    public function save($system,$table,$id,$newData){

        switch ($system){
            case 'json':                
                $jsnUsers = file_get_contents($this->jsonFile);
                $arrUsers = json_decode($jsnUsers, true);                

                if ($id==0){
                    if (!empty($arrUsers)){
                        $append = $this->getMaxId();
                        setId($append);
                        array_push($arrUsers, $newData);
                    }else{
                        $arrUsers[] = $newData;
                    }                    
                }else{
                    $singleUser = array_filter(
                        $arrUsers, 
                        // function($obj) { return $ojb->id === $id }
                    );
                    $singleUser = $newData;                
                }
                // ACCION DE GRABAR
                $result = file_put_contents($this->jsonFile, json_encode($singleUser));
                return $result? true : false;                
            break;
        
            case 'mysql':
                $insert = "insert into " . $table . " values(null,".$data.")";
                $result = $this->db->query($insert);
                return $result? true : false;  
            break;

            case 'mongo':
                echo "metodo con mongo";
                // to-do
            break;
        }

    }

    // implementamos aquí el SAVE a JSON:
    // public function save($data){

    //     echo "estoy dentro del save";        
    //     // cambia el ESTADO de los Atributos, pero es VOLATIL
    //     $this->setUserName($data['nom']);
    //     $this->setUserRol($data['rol']);
    //     // cambia en FICHERO su contenido, PERSISTENCIA de datos
    //     json_encode($data);
    //     file_put_contents("../db/users.json",$data);
    // }

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