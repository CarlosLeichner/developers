<?php

echo "entrant a UserController... <br>";

class UserController extends ApplicationController
{
	public function indexAction(){
        //Leemos el JSON
        $data_users = file_get_contents("../db/users.json");
        $json_users = json_decode($data_users, true);
        foreach ($json_users as $register){
            foreach ($register as $field) {    
                echo $field." - ";
            }
            echo "<br>";
        }
    }

    // include_once("../models/UserModel.php");

    // define('objUSERS',file_get_contents("../db/users.json"));
    // define('objUSERS', JSON.parse("../db/users.json"));
    // $arrUsers = JSON.stringify("../db/users.json");
    // var_dump($arrUsers);


}

?>