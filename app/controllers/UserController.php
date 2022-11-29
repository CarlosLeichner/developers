<?php

echo "entrant a UserController... <br><br>";

require_once ROOT_PATH . ('/app/models/UserModel.php');

class UserController extends ApplicationController
{    
    // LANDING - Funció per Mostrar
	public function indexAction(){
        

        echo "estoy en indexAction!!";        
        // vista
        // require_once ROOT_PATH . ("/app/views/scripts/user/index.phtml");
        
        if (isset($_POST['inpName'])){

            // echo "estoy en IF de btnEntrar <br><br>";            
            $fields = array(
                'nom' => $_POST["inpName"],
                'rol' => $_POST["inpRol"]
            );        
            // var_dump($fields);                        
            $objUser = new UserModel($fields);       
            // echo "var_dump de controller<br>";
            // var_dump($objUser);

            // obrim sessió perquè no dupliqui gent
            if (!isset($_SESSION)){
                session_start();
            }            
            header("Location: " . "/listtask");
        }                
    }

    public function addAction(){                
        
        // header('Location:' .ROOT_PATH.'/app/views/scripts/user/index.phtml');

        // echo "entrando a user Add";
        echo "entrando a user addAction <br> <br>";
        exit;

        if (!empty($_POST)) {
        
            // 1. recollim les dades
            $fields = array(
                'nom' => $_POST["inpName"],
                'rol' => $_POST["inpRol"]
            );

            // 1.1. TEST
            // $data['nom'] = "nombreTest";   
			// $data['rol'] = "rolTest";      

            // 2. Instanciem l'objecte real        
            $objUser = new UserModel($fields);
        
            // 3. interactuar amb Model (mètode seu) per llegir/grabar
                               
        }
		
        // 4. redireccionem cap a la pàgina de view que volguem
        header('Location:' .ROOT_PATH.'/app/views/scripts/user/index.phtml');
                
        // 5. Tota funció ha de retornar quelcom (true = ha anat bé)
        return true;
    }

    // Funció per Eliminar
    public function delAction($id){
        // Instanciem l'objecte real        
        $objUser = new UserModel();
            $data['nom'] = $_POST["inpName"];
            $data['rol'] = $_POST["inpRol"]; 
        $objUser->save($data);
        return true;
    }
    // Funció per Modificar - vista modif 


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