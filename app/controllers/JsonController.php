<?php
session_start();
require_once ("app/models/ClassJson.php");
require __DIR__.'db/tasks.json';
$task = new Json('db/tasks.json'); 
 
// Set default redirect url 
$redirectURL = ('web/index.php'); 
// Submitted form  
$taskData = array( 
    'description' => $description, 
    'created_at' => $created_at, 
    'currentStatus' => $currentStatus, 
    'masterUsr_id' => $masterUsr_id,
    'slaveUsr_id' =>  $slaveUsr_id,
    'initiated'=> $initiated,
    'done'=> $done,
    'deleted'=> $deleted
); 
function createTask($taskData){
    if ( !empty($_POST)) { 
        $data = file_get_contents('db/tasks.json');
        $data = json_decode($data, true);
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
        $data []= $taskData;
        $data = json_encode($data, JSON_PRETTY_PRINT);
		file_put_contents('users.json', $data);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $taskData = array_merge($taskData, $_POST);}
    if ($taskData){
        $task = createTask($_POST);
        return $task;
    }
     
}
function deleteTask($task){
     if (!isset($_GET['id'])) {
        echo "not found";
        exit;
    }
    $taskId = $_GET['id'];
    $task->deletetask($taskId);
    
}
function updateTask($id, $task, $taskData){
    if (!isset($_GET['id'])) {
        echo "not found";
        exit;
    }
    $taskId = $_GET['id'];
    $data = file_get_contents('users.json');
	$task = json_decode($data, true);
    $task =  $task->getTaskbyID($taskId);
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
    $task->updateTask();
    $task[$taskId] = $taskData;
 
	$data = json_encode($taskData, JSON_PRETTY_PRINT);
	file_put_contents('db/tasks.json', $data);
    }
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
     
    
     
    // Store the submitted field value in the session 
    $sessData['taskData'] = $taskData; 
    // Submit the form data 
    if(empty($errorMsg)){ 
        if(!empty($_POST['id'])){ 
            // Update task data 
            $update = $task->updateTask($taskData, $_POST['id']); 
             
            if($update){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been updated successfully.'; 
                 
                // Remove submitted fields value from session 
                unset($sessData['taskData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                // Set redirect url 
                $redirectURL = 'web/index.php'.$id_str; 
            } 
        }else{ 
            // Insert user data 
            $insert = $task->createTask($taskData); 
             
            if($insert){ 
                $sessData['status']['type'] = 'success'; 
                $sessData['status']['msg'] = 'Member data has been added successfully.'; 
                 
                // Remove submitted fields value from session 
                unset($sessData['taskData']); 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
                 
                // Set redirect url 
                $redirectURL = 'web/index.php'.$id_str; 
            } 
        } 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'web/index.php'.$id_str; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){ 
    // Delete data 
    $delete = $task->deleteTask($_GET['id']); 
     
    if($delete){ 
        $sessData['status']['type'] = 'success'; 
        $sessData['status']['msg'] = 'Member data has been deleted successfully.'; 
    }else{ 
        $sessData['status']['type'] = 'error'; 
        $sessData['status']['msg'] = 'Some problem occurred, please try again.'; 
    } 
     
    // Store status into the session 
    $_SESSION['sessData'] = $sessData; 
} 
    
 
// Redirect to the respective page 
header("Location:".$redirectURL);  
exit();

?>