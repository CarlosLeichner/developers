<?php 

 session_start();

// define('ROOT_PATH', '/app/models/taskModel.class.php');
  require_once ROOT_PATH . ('/app/models/taskModel.class.php');    

class TaskController extends ApplicationController{

    public function indexAction(){        
    
            echo "not found";
            
            
        
        
        $TaskObj = new JsonModel();
        $this->taskData = $TaskObj->getTasks();
        //$this->taskData = $TaskObj->getTaskbyID($id_task);
        
    }
    public function addAction(){
        $TaskObj = new JsonModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ( !empty($_POST)) { 
                
                $taskData = array (
                    
                        'description' => $_POST ['description'], 
                        'created_at' => $_POST ['created_at'], 
                        'currentStatus' => $_POST ['currentStatus'], 
                        'masterUsr_id' => $_POST ['masterUsr_id'],
                        'slaveUsr_id' =>  $_POST ['slaveUsr_id'],
                        'initiated'=> $_POST ['initiated'],
                        'done'=> $_POST ['done'],
                        'deleted'=> $_POST ['deleted']
                );
                
                $TaskObj->createTask($taskData);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = array_merge($taskData, $_POST);}
            if ($data){
                $TaskObj->createTask($data);
                return $TaskObj;
                header('Location: ' . ROOT_PATH . '../web/index');
            }
        }
    }
    public function editAction(){
        $id_task = $_GET['id_task'];
        $TaskObj = new JsonModel();
        $TaskObj->getTaskbyID($id_task);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if(isset($_GET['id_task'])){
                if ($_GET['id_task']=== 1) {
                $taskData = array(

                    'description' => $_POST ['description'], 
                    'created_at' => $_POST ['created_at'], 
                    'currentStatus' => $_POST ['currentStatus'], 
                    'masterUsr_id' => $_POST ['masterUsr_id'],
                    'slaveUsr_id' =>  $_POST ['slaveUsr_id'],
                    'initiated'=> $_POST ['initiated'],
                    'done'=> $_POST ['done'],
                    'deleted'=> $_POST ['deleted']
                    );}
                    
            $TaskObj->updateTask($id_task);
            $task[$id_task] = $taskData;
            header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
            }
        } if (!isset($_POST['id_task'])) {
            echo "not found edittask";
            exit;
        }
        
            
            //  validation 
            $errorMsg = ''; 
            if(empty($description)){ 
                $errorMsg .= '<p>Please enter valid description.</p>'; 
            } 
            if(empty($created_at)) { 
                $errorMsg .= '<p>Please enter a valid date.</p>'; 
            } 
            if(empty($currentStatus)){ 
                $errorMsg .= '<p>Please set a status.</p>'; 
            } 
            if(empty($masterUsr_id)){ 
                $errorMsg .= '<p>Please enter valid ID.</p>'; 
            } 
            if(empty($slaverUsr_id)){ 
                $errorMsg .= '<p>Please enter valid ID.</p>'; 
            } 
        
            
            
        // Store the submitted field value in the session 
        $sessData['taskData'] = $taskData; 
        // Submit the form data 
        if(empty($errorMsg)){ 
            if(!empty($_POST['id_task'])){ 
                // Update task data 
                $update = $TaskObj->updateTask($id_task); 
                
                if($update){ 
                    $sessData['status']['type'] = 'success'; 
                    $sessData['status']['msg'] = 'Member data has been updated successfully.'; 
                    
                    // Remove submitted fields value from session 
                    unset($sessData['taskData']); 
                }else { 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                    // Set redirect url 
                    
                }
                    
            }
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
    }
    public function delAction(){
        $id_task = $_GET['id_task'];
        if (!isset($_GET['id_task'])) {
            echo "not found";
            exit;
        }else {
            $TaskObj = new JsonModel();

            $TaskObj->getTaskbyID($id_task);
        }
        if (!empty($task)) {
            $TaskObj->deleteTask($id_task);
        }else {
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
    }
    public function viewAction(){
        $id_task = $_GET['id_task'];
 //       if (!isset($_GET['id_task'])) {
   //         echo "not found";
     //       exit;
       // }else {
            $TaskObj = new JsonModel();

            $TaskObj->getTaskbyID($id_task);
        //}
    
    
    }
}   

?>