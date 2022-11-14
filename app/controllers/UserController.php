<?php

echo "entrant a UserController... <br><br>";
// include_once(".\app\models\UserModel.php");
// include_once("UserModel.php");
include("UserModel.php");
// require './Models/EmployeeModel.php';

class UserController extends ApplicationController
{    
    // Funció per Afegir
    public function AddUser(){

        $objUser = new UserModel();
			$data['nom'] = $this->request->getVar("isbn");
			$data['rol'] = $this->request->getVar("title");
			$objUser->save($data);
    }

    // Funció per Eliminar
    // Funció per Modificar - vista modif 

    // Funció per Mostrar
	public function indexAction(){
        // Mostrem el JSON tal qual tipus TXT:
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

        // Instanciem l'objecte real - omplint Array d'Objectes per cada User 
        $arrUsers = [];
        foreach ($json_users as $register){
            $objUser = new User("1",$register[1],$register[2]);
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