<?php

require_once ROOT_PATH . ('/lib/base/Model.php');


class JsonModel extends Model{

    private $json_file ;
    private $tasks;
    private $number_of_records;
    private $ids = [];
    private $description;
    private $created_at;
    private $currentStatus;
    private $masterUsr_id;
    private $slaveUsr_id;
    private $initiated;
    private $done;
    private $deleted;

    public function __construct(){
        $this->json_file =('db/tasks.json');
        $this->tasks = json_decode(file_get_contents($this->json_file), true);
        $this->number_of_records = count($this->tasks);
        $this->created_at = date("Y-m-d H:i:s");
        $this->initiated = date("Y-m-d H:i:s");
        $this->done = date("Y-m-d H:i:s");
        
        
    }
    private function setTaskId(array $task){
        if($this->number_of_records == 0){
           $task['id'] = 1;
        }else{
           $task['id'] = max($this->ids) + 1;
        }
        return $task;
    }
    function getTasks(){
        return $this->tasks;
    }
    function getTaskbyID($id_task){
        $tasks= $this->tasks;
        foreach ($tasks as $task) {
            if ($task['id_task'] == $id_task) {
                return $tasks[$task];
            }
        }
        return null;
    }
    
    public function createTask(array $new_task){
        $taskWithId = $this->setTaskId($new_task);
        array_push($this->tasks, $taskWithId);
   
        
        if($this->number_of_records == 0){
           $this->putJson();
        }else{
            if(!in_array($new_task['currentStatus'], $this->currentStatus)){
                $this->putJson();
            }
            if(!in_array($new_task['masterUsr_id'], $this->masterUsr_id)){
                $this->putJson();
            }
            if(!in_array($new_task['slaveUsr_id'], $this->slaveUsr_id)){
                $this->putJson();
            }
            if(!in_array($new_task['deleted'], $this->deleted)){
                $this->putJson();
            }
            
        }
     }
    function updateTask($id_task){
        foreach($this->tasks as $key => $value){
            if($value['id_task'] === $id_task){ 
               $this->tasks[$value]['id_task'] = $id_task;
                if ($value['id_task'] === $id_task){ 
                    if(!empty($this->tasks) && is_array($this->tasks) && !empty($id)){ 
                        if(isset($this->tasks['description'])){ 
                            $this->tasks[$key]['description'] = $this->description; 
                            $this->putJson();
                        } 
                        if(isset($this->tasks['masterUsr_id'])){ 
                            $this->tasks[$key]['masterUsr_id'] = $this->masterUsr_id;
                            $this->putJson(); 
                        } 
                        if(isset($this->tasks['slaveUsr_id'])){ 
                            $this->tasks[$key]['slaveUsr_id'] = $this->slaveUsr_id; 
                            $this->putJson();
                        } 
                        if(isset($this->tasks['initiated'])){ 
                            $this->tasks[$key]['initiated'] = $this->initiated; 
                            $this->putJson();
                        } 
                        if(isset($this->tasks['done'])){ 
                            $this->tasks[$key]['done'] = $this->done; 
                            $this->putJson();
                        } 
                        if(isset($this->tasks['currentStatus'])){ 
                            $this->tasks[$key]['currentStatus'] = $this->currentStatus; 
                            $this->putJson();
                        } 
                        if(isset($this->tasks['deleted'])){ 
                            $this->tasks[$key]['deleted'] = $this->deleted;
                            $this->putJson(); 
                        }
                 
                    } 
             
                }
                return $this->tasks['id_task'];        
            }
        }
    }

    function deleteTask($id_task){
        $tasks = $this->tasks;
        foreach($tasks as $key => $value){
            if($value['id'] === $id_task){
               $tasks[$key]['currentStatus'] = 'deleted';
            }
         }
         $this->putJson();
    }
    function initiatedTask($id_task){
        $tasks = $this->tasks;
        foreach($tasks as $key => $value){
            if($value['id'] === $id_task){
               $tasks[$key]['currentStatus'] = 'initiated';
               $tasks[$key]['initiated'] = $this->initiated;
            }
         }
         $this->putJson();
    }
    function completedTask($id_task){
        $tasks = $this->tasks;
        foreach($tasks as $key => $value){
            if($value['id'] === $id_task){
               $tasks[$key]['currentStatus'] = 'completed';
               $tasks[$key]['done'] = $this->done;
            }
         }
         $this->putJson();
    }
    
    private function putJson()
    {
        file_put_contents($this->json_file, json_encode($this->tasks, JSON_PRETTY_PRINT));
    }

}


?>