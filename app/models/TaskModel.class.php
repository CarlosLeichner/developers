<?php

require_once ROOT_PATH . ('/lib/base/Model.php');


class Task {

    
    private $arrTask = array (
        'id_task' => '0',
        'created_at' => '',
        'description' => '',
        'currentStatus' => 'created',
        'done' => '',
        'initialized' => '',
        'deleted' => '',
        'masterUsr_id'=>'',
        'slaveUsr_id'=>''
    );
    
    public function __construct(){
        if (!file_exists(PHP_CONFIG_FILE_PATH. '/database/'. '-tasks.jason')) {
            $tasks = $this->putJson();
        }else {
            $tasks = $this->getJson();
        }
        
        $this->arrTask = $tasks;
        
        
    }
    private function setTaskId(){
        
        if($this->arrTask['id_task']===0){
            $this->arrTask['id_task'] = 1;
        }else{
           $arrTask['id_task'] = max($this->arrTask) + 1;
        }
        
    }
    function getTasks(){
        $this->arrTask = $this->putJson();
        return $this->arrTask;
    }
    function getTaskbyID($id_task){
        
        $tasks = $this->arrTask;
        echo $tasks;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if ($value['id_task'] == $id_task) {
                    echo $tasks[$key];
                    return $tasks[$key];
                }
            }
        }
        
    }
    
    public function createTask($slaveUsr_id, $masterUsr_id, $description ,$created_at, $initiated, $done, $deleted, $currentStatus){
        $taskWithId = $this->setTaskId();
        $tasks = $this->arrTask;
        $tasks = $this->putJson();
   
        
        if($this->arrTask['id_task']===0){
           $this->putJson();
        }else{
            if(!in_array($this->arrTask['currentStatus'], $currentStatus)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['initiated'], $initiated)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['created_at'], $created_at)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['description'], $description)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['done'], $done)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['masterUsr_id'], $masterUsr_id)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['slaveUsr_id'], $slaveUsr_id)){
                $this->putJson();
            }
            if(!in_array($this->arrTask['deleted'], $deleted)){
                $this->putJson();
            }
            
        }return $tasks;
    }
    public function updateTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id_task'] === $id_task){ 
                $tasks[$value]['id_task'] = $id_task;
                    if ($value['id_task'] === $id_task){ 
                        if(!empty($tasks) && is_array($tasks) && !empty($id_task)){ 
                            if(isset($tasks['description'])){ 
                                $tasks[$key]['description'] = 'description'; 
                                $this->putJson();
                            } 
                            
                            if(isset($tasks['initiated'])){ 
                                $tasks[$key]['initiated'] = 'initiated'; 
                                $this->putJson();
                            } 
                            if(isset($tasks['done'])){ 
                                $tasks[$key]['done'] = 'done'; 
                                $this->putJson();
                            } 
                            if(isset($tasks['currentStatus'])){ 
                                $tasks[$key]['currentStatus'] = 'currentStatus'; 
                                $this->putJson();
                            } 
                            if(isset($tasks['deleted'])){ 
                                $tasks[$key]['deleted'] = 'deleted';
                                $this->putJson(); 
                            }
                    
                        } 
                
                    }
                    return $tasks['id_task'];        
                }
            }
        }
    }

    public function deleteTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if ($value['id_task'] == $id_task) {
                    $tasks[$key]['currentStatus'] = 'deleted';
                    $tasks[$key]['deleted'] = true;
                }
            }
            $this->putJson();
        }
    }
    public function initiatedTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id'] === $id_task){
                $tasks[$key]['currentStatus'] = 'initiated';
                $tasks[$key]['initiated'] = date("Y-m-d H:i:s");
                }
            }
            $this->putJson();
        }
    }
    public function completedTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id'] === $id_task){
                $tasks[$key]['currentStatus'] = 'completed';
                $tasks[$key]['done'] = date("Y-m-d H:i:s");
                }
            }
         $this->putJson();
        }
    }
    public function viewTask($id_Task){
        $tasks = $this->arrTask;
        if (!$tasks) {
            return false;
        } else if ($tasks['id_Task']=== $id_Task) {
            return $tasks;
        }
        
    }
    
    private function putJson()
    {
    json_decode(file_put_contents(PHP_CONFIG_FILE_PATH. '-tasks.jason', [],JSON_PRETTY_PRINT));
        
    }
    private function getJson()
    {
    json_decode(file_get_contents(PHP_CONFIG_FILE_PATH. '/database/'. '-tasks.jason', true ,JSON_PRETTY_PRINT));
        
    }
}


?>