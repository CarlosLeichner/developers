<?php
session_start();
require __DIR__.'db/tasks.json';
require_once ROOT_PATH . '/app/models/jsonModel.class.php';

$redirectURL = ('web/index.php'); 
class JsonController extends ApplicationController{
    protected $taskData;
    function __contruct (){
        $this->taskData = array( 
            'description' => $this->description, 
            'created_at' => $this->created_at, 
            'currentStatus' => $this->currentStatus, 
            'masterUsr_id' => $this->masterUsr_id,
            'slaveUsr_id' =>  $this->slaveUsr_id,
            'initiated'=> $this->initiated,
            'done'=> $this->done,
            'deleted'=> $this->deleted
        ); 
    }
    public function indexAction($id){
        $TaskObj = new JsonModel();
        $taskData = $TaskObj->getTasks();
        $taskData = $TaskObj->getTaskbyID($id);
        require_once ('/app/views/scripts/task/index.html');
    }
    function addAction($taskData){
        if ( !empty($_POST)) { 
            $data = file_get_contents('db/tasks.json');
            $data = json_decode($data, true);
            $this->taskData = array (
                
                    'description' => $_POST ['description'], 
                    'created_at' => $_POST ['created_at'], 
                    'currentStatus' => $_POST ['currentStatus'], 
                    'masterUsr_id' => $_POST ['masterUsr_id'],
                    'slaveUsr_id' =>  $_POST ['slaveUsr_id'],
                    'initiated'=> $_POST ['initiated'],
                    'done'=> $_POST ['done'],
                    'deleted'=> $_POST ['deleted']
            );
            $TaskObj = new JsonModel();
            $TaskObj->createTask($this->taskData);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->taskData = array_merge($this->taskData, $_POST);}
        if ($this->taskData){
            $this->TaskObj->createTask();
            return $this->TaskObj;
            header('Location: ' . ROOT_PATH . '/app/views/scripts/task/index.phtml');
        }
        
    }
    function editAction($id){
        if (!isset($_GET['id'])) {
            echo "not found";
            exit;
        }
        $TaskObj = new JsonModel();
        $taskId = $_GET['id'];
        $data = file_get_contents('users.json');
        $task = json_decode($data, true);
        $task =  $TaskObj->getTaskbyID($id);
        if (!$task) {
            echo "not found";
            exit;
        }
        if(isset($_POST['id'])){
        $taskData = array(
            'description' => $_POST ['description'], 
            'created_at' => $_POST ['created_at'], 
            'currentStatus' => $_POST ['currentStatus'], 
            'masterUsr_id' => $_POST ['masterUsr_id'],
            'slaveUsr_id' =>  $_POST ['slaveUsr_id'],
            'initiated'=> $_POST ['initiated'],
            'done'=> $_POST ['done'],
            'deleted'=> $_POST ['deleted']
            );
        $TaskObj->updateTask($id);
        $task[$taskId] = $taskData;
    
        $data = json_encode($this->taskData, JSON_PRETTY_PRINT);
        file_put_contents('db/tasks.json', $data);
        }

        if(isset($_POST['taskSubmit'])){ 
            // Get form fields value 
            $id = $_POST['id']; 
            $description = trim(strip_tags($_POST['description'])); 
            $created_at = trim(strip_tags($_POST['created_at'])); 
            $currentStatus = trim(strip_tags($_POST['currentStatus'])); 
            $masterUsr_id = trim(strip_tags($_POST['masterUsr_id'])); 
            $slaveUsr_id = trim(strip_tags($_POST['slaveUsr_id'])); 

            $id_str = ''; 
            if(!empty($id)){ 
                $id_str = '?id='.$id; 
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
        }
            
            
        // Store the submitted field value in the session 
        $sessData['taskData'] = $taskData; 
        // Submit the form data 
        if(empty($errorMsg)){ 
            if(!empty($_POST['id'])){ 
                // Update task data 
                $update = $TaskObj->updateTask($id); 
                
                if($update){ 
                    $sessData['status']['type'] = 'success'; 
                    $sessData['status']['msg'] = 'Member data has been updated successfully.'; 
                    
                    // Remove submitted fields value from session 
                    unset($sessData['taskData']); 
                }else { 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                    // Set redirect url 
                    $redirectURL = 'web/index.php'.$id_str; 
                }
                    
            }
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/task/index.phtml');
    }
    function delAction($id){
        if (!isset($_GET['id'])) {
            echo "not found";
            exit;
        }else {
            $TaskObj = new JsonModel();
            
            $data = file_get_contents('tasks.json');
            $task = json_decode($data, true);
            $task =  $TaskObj->getTaskbyID($id);
        }
        if (!empty($task)) {
            $TaskObj->deleteTask($id);
        }else {
            echo "task not found";
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/task/index.phtml');
    }
    
}   

?>