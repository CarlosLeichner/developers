<?php 

class TaskController extends Controller{

    public function indexAction(){        
        
           
        $TaskObj = new Task();
        $tasks = $TaskObj->getTasks();
     
        
    }
    public function addAction(){
        
        $TaskObj = new Task();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!empty($_POST['description']) && !empty($_POST['masterUsr_id']) && !empty($_POST['slaveUsr_id']) && !empty($_POST['masterUsr_id'])) { 

                $taskData = array ( 
                    $id_task= $_POST ['id_task'],
                    $description = $_POST ['description'], 
                    $created_at = date("Y-m-d H:i:s"),  
                    $masterUsr_id = $_POST ['masterUsr_id'],
                    $slaveUsr_id =  $_POST ['slaveUsr_id'],
                    $initiated =  $_POST ['initiated'],
                    $done = $_POST ['done'],
                    $deleted = '0'
                );
                // var_dump($taskData);
                
                $TaskObj->createTask($slaveUsr_id, $masterUsr_id, $description ,$created_at, $initiated, $done, $deleted);
            }
           
                header('Location: listtask');
        }
    }
    
    public function editAction(){
        $id_task = $_GET['id_task'];
        $TaskObj = new Task();
        $TaskObj->getTaskbyID($id_task);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            if(isset($_GET['id_task'])){
                if ($_GET['id_task']=== $id_task) {
                $taskData = array(

                    $description = $_POST ['description'], 
                    $created_at = $_POST ['created_at'], 
                    $currentStatus = $_POST ['currentStatus'], 
                    $masterUsr_id = $_POST ['masterUsr_id'],
                    $slaveUsr_id =  $_POST ['slaveUsr_id'],
                    $initiated =  $_POST ['initiated'],
                    $done = $_POST ['done'],
                    $deleted = $_POST ['deleted']
                    );}
                    
            $TaskObj->updateTask($id_task, $slaveUsr_id, $masterUsr_id, $description ,$created_at, $initiated, $done, $deleted, $currentStatus);
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
                $update = $TaskObj->updateTask($id_task, $slaveUsr_id, $masterUsr_id, $description ,$created_at, $initiated, $done, $deleted, $currentStatus); 
                
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
        header('Location: listtask');    }
    public function delAction(){
        $id_task = $_GET['id_task'];
        if (!isset($_GET['id_task'])) {
            echo "not found";
            exit;
        }else {
            $TaskObj = new Task();

            $TaskObj->getTaskbyID($id_task);
        }
        if (!empty($task)) {
            $TaskObj->deleteTask($id_task);
        }
        header('Location: listtask');
    }
    public function viewAction(){
        $id_task = $_GET['id_task'];
 //       if (!isset($_GET['id_task'])) {
   //         echo "not found";
     //       exit;
       // }else {
            $TaskObj = new Task();

            $TaskObj->getTaskbyID($id_task);
        //}
    
    
    }public function searchAction(){
        $id_task = $_GET['id_task'];
 
        $TaskObj = new Task();

        $TaskObj->getTaskbyID($id_task);
        
    }
    
    
}   

?>