<?php
session_start();
//require (__FILE__. ('/db/tasks.json'));
require_once ROOT_PATH . ('/app/models/jsonModel.class.php');


class JsonController extends Controller{
    public $taskData;
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
    public function indexAction($id_task){
        if (!isset($_GET['id_task'])) {
            echo "not found";
            exit;
        }
        
        $TaskObj = new JsonModel();
        $this->taskData = $TaskObj->getTasks();
        $this->taskData = $TaskObj->getTaskbyID($id_task);
        require_once ('/app/views/scripts/index.html');
    }
    function addAction($taskData){
        echo "actiondeleted";
        exit;
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
            header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
        }
        
    }
    function editAction($id_task){
        echo "actiondeleted";
        exit;
        if (!isset($_GET['id_task'])) {
            echo "not found";
            exit;
        }
        $TaskObj = new JsonModel();
        $taskId = $_GET['id_task'];
        $data = file_get_contents('tasks.json');
        $task = json_decode($data, true);
        $task =  $TaskObj->getTaskbyID($id_task);
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
        $TaskObj->updateTask($id_task);
        $task[$taskId] = $taskData;
    
        $data = json_encode($this->taskData, JSON_PRETTY_PRINT);
        file_put_contents('db/tasks.json', $data);
        }

        if(isset($_POST['taskSubmit'])){ 
            // Get form fields value 
            $id_task = $_POST['id_task']; 
            $description = trim(strip_tags($_POST['description'])); 
            $created_at = trim(strip_tags($_POST['created_at'])); 
            $currentStatus = trim(strip_tags($_POST['currentStatus'])); 
            $masterUsr_id = trim(strip_tags($_POST['masterUsr_id'])); 
            $slaveUsr_id = trim(strip_tags($_POST['slaveUsr_id'])); 

            $id_str = ''; 
            if(!empty($id_task)){ 
                $id_str = '?id_task='.$id_task; 
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
                    $redirectURL = 'web/index.php'.$id_str; 
                }
                    
            }
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
    }
    function delAction($id_task){
        echo "actiondeleted";
        exit;
        if (!isset($_GET['id_task'])) {
            echo "not found";
            exit;
        }else {
            $TaskObj = new JsonModel();
            
            $data = file_get_contents('tasks.json');
            $task = json_decode($data, true);
            $task =  $TaskObj->getTaskbyID($id_task);
        }
        if (!empty($task)) {
            $TaskObj->deleteTask($id_task);
        }else {
            echo "task not found";
        }
        header('Location: ' . ROOT_PATH . '/app/views/scripts/index.phtml');
    }
    
}   

?>