<?php

echo "entrant a UserController... <br><br>";

require_once ROOT_PATH . '/app/models/UserModel.php';

class UserController extends ApplicationController
{    
    // Funció per Afegir
    public function add(){
        $data = ['nom'=>'','rol'=>''];
        // Instanciem l'objecte real        
        $objUser = new UserModel();
		    $data['nom'] = "nombreTest";   // $_POST["inpName"];
			$data['rol'] = "rolTest";      // $_POST["inpRol"]; 
		$objUser->save($data);
        return true;
    }

    // Funció per Eliminar
    public function delete($id){
        // Instanciem l'objecte real        
        $objUser = new UserModel();
            $data['nom'] = $_POST["inpName"];
            $data['rol'] = $_POST["inpRol"]; 
        $objUser->save($data);
        return true;
    }
    // Funció per Modificar - vista modif 

    // Funció per Mostrar
	public function indexAction(){
        // instanciar l'objecte segons el Model
        $objUser = new UserModel();
        // executar el mètode de classe per retornar el cod=1
        $data = $objUser->showAll("users","1");
        $data = $objUser->showById("users","1");
        require_once("/app/views/scripts/user/index.phtml");
    }

    function proves(){
        // Instanciem l'objecte real - omplint Array d'Objectes per cada User 
        $arrUsers = [];
        foreach ($json_users as $register){
            // $objUser = new UserModel("1",$register[1],$register[2]);
            $objUser = new UserModel;
            // $objUser->__construct($id,$name,$rol)
            // $objUser->setName($register[1]);
            // $objUser->setRol($register[2]);            
            array_push($arrUsers,$objUser);
        }

        foreach ($arrUsers as $person){
            echo $person->showUsers();
        }
        // $objUser->showUser();
    }
    

    // define('objUSERS',file_get_contents("../db/users.json"));
    // define('objUSERS', JSON.parse("../db/users.json"));
    // $arrUsers = JSON.stringify("../db/users.json");
    // var_dump($arrUsers);


}

?>