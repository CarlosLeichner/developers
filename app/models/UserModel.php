<?php

class UserModel {

    // ATRIBUTS
    private $_jsonFile = ROOT_PATH . ("/db/users.json"); 

    public $_arrUsers;

    public $_fields = array(
        'id_user' => '0',
        'strCreatedAt' => '',
        'name' => '',
        'cog'  => '',
        'rol'  => '',
        'deleted' => '0'
    );

    // CONSTRUCTOR      
    public function __construct($arrFields){
        
        if (!file_exists(ROOT_PATH . "/db/users.json")){
            $this->_jsonFile = file_put_contents(ROOT_PATH . "/db/users.json","[]");
        }
        // file_get: llegeix Fitxer txt (retorna text, en aquest cas format json)
        $jsnUsers = file_get_contents($this->_jsonFile);
        // json_decode:  converteix un JSON string, en un ARRAY
        $arrUsers = json_decode($jsnUsers, true);             
        // ens guardem en State la llista d'users
        $this->_arrUsers = $arrUsers;

        // ens guardem en State l'usuari actual que ha entrat
        $this->_fields=array(
            'id_user' => $this->getMaxId(),
            'createdAt' => date("Y-m-d H:i:s"),
            'name' => $arrFields['nom'],
            'rol'  => $arrFields['rol'],
            'deleted' => '0'
        );  
        // echo "en UserModel::__construct() ... var_dump de this->_fields:<br>";
        // var_dump($this->_fields);
    }

    public function exists($nom){
        echo "<br>function exists -> $ nom = " . $nom ."<br>";
        $match = false;

        foreach ($this->_arrUsers as $user) {
            // echo "var_dump de $ user : " . var_dump($user) . "<br>";
            if ($user['name'] == $nom) {
                $match = true;
            }
        }
        echo "match: " . $match;
        return $match;
    }

    public function saveJson($arrUsers, array $singleUser){
        $result = false;
        if (!empty($singleUser)){      
            // afegim al STATE dels Atributs, pero encara és VOLATIL
            array_push($arrUsers, $singleUser); 
            // json_encode:  converteix un ARRAY en un JSON string
            $jsnUsers = json_encode($arrUsers);
            // file_put: graba en Fitxer txt
            $result = file_put_contents($this->_jsonFile,$jsnUsers);
            // tot lo d'abans però en una fila:
            // $result = file_put_contents($this->_jsonFile, json_encode($arrUsers));
        }
        return $result? true : false;                
    }

    // GETTERS-SETTERS
    public function getFields(){
        // if ($field==''){
            return $this->_fields;
        // }else{
            // return $this->_fields[$field];
        // }
    }

    // private function setFields($arrFields){    
    //     if ($arrFields[0]==0) {
    //         $arrFields[0] = getMaxId();
    //     }
    //     $data = [
    //         $id_User = $arrFields[0],
    //         $strCreatedAt = date("Y-m-d H:i:s"),  // formato "2022-12-31 15:30:54"
    //         $name = $arrFields[1],
    //         $rol = $arrFields[2],           
    //         $deleted = $arrFields[3],
    //     ];
    //     array_push($this->_arrFields,$data);
    // }

    // METODES ESPECIFICS de Classe:
    private function getMaxId(){
        $maxId = count($this->_arrUsers)+1; 
        echo "<br> UserModel->getMaxId...maxId: " . $maxId . "<br>";
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