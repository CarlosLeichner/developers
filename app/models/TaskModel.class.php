<?php

require_once ROOT_PATH . ('/lib/base/Model.php');


class JsonModel extends Model{

    // private $json_file ;
    // private $tasks;
    // private $number_of_records;
    // private $ids = [];
    // private $description;
    // private $created_at;
    // private $currentStatus;
    // private $masterUsr_id;
    // private $slaveUsr_id;
    // private $initiated;
    // private $done;
    // private $deleted;
    private $arrTask;

    public function __construct(){
        if (!file_exists(PHP_CONFIG_FILE_PATH. '/database/'. '-tasks.jason')) {
            $tasks = $this->putJson();
        }else {
            $tasks = $this->getJson();
        }
        
        $this->arrTask = $tasks;
        
    }
    private function setTaskId(){
        $number_of_records=0;
        if($number_of_records == 0){
           $arrTask['id'] = 1;
        }else{
           $arrTask['id'] = max($this->ids) + 1;
        }
        
    }
    function getTasks(){
        $this->arrTask = $this->putJson();
        return $this->arrTask;
    }
    function getTaskbyID($id_task){
        echo $id_task;
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
    
    public function createTask($arrTask){
        $taskWithId = $this->setTaskId();
        $tasks = $this->arrTask;
        $tasks = $this->putJson();
   
        
        if($this->number_of_records == 0){
           $this->putJson();
        }else{
            if(!in_array($arrTask['currentStatus'], $this->currentStatus)){
                $this->putJson();
            }
            if(!in_array($arrTask['masterUsr_id'], $this->masterUsr_id)){
                $this->putJson();
            }
            if(!in_array($arrTask['slaveUsr_id'], $this->slaveUsr_id)){
                $this->putJson();
            }
            if(!in_array($arrTask['deleted'], $this->deleted)){
                $this->putJson();
            }
            
        }return $tasks;
     }
    function updateTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id_task'] === $id_task){ 
                $tasks[$value]['id_task'] = $id_task;
                    if ($value['id_task'] === $id_task){ 
                        if(!empty($tasks) && is_array($tasks) && !empty($id_task)){ 
                            if(isset($tasks['description'])){ 
                                $tasks[$key]['description'] = $this->description; 
                                $this->putJson();
                            } 
                            if(isset($this->tasks['masterUsr_id'])){ 
                                $this->tasks[$key]['masterUsr_id'] = $this->masterUsr_id;
                                $this->putJson(); 
                            } 
                            if(isset($tasks['slaveUsr_id'])){ 
                                $tasks[$key]['slaveUsr_id'] = $this->slaveUsr_id; 
                                $this->putJson();
                            } 
                            if(isset($tasks['initiated'])){ 
                                $tasks[$key]['initiated'] = $this->initiated; 
                                $this->putJson();
                            } 
                            if(isset($tasks['done'])){ 
                                $tasks[$key]['done'] = $this->done; 
                                $this->putJson();
                            } 
                            if(isset($tasks['currentStatus'])){ 
                                $tasks[$key]['currentStatus'] = $this->currentStatus; 
                                $this->putJson();
                            } 
                            if(isset($tasks['deleted'])){ 
                                $tasks[$key]['deleted'] = $this->deleted;
                                $this->putJson(); 
                            }
                    
                        } 
                
                    }
                    return $tasks['id_task'];        
                }
            }
        }
    }

    function deleteTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if ($value['id_task'] == $id_task) {
                    $tasks[$key]['currentStatus'] = 'deleted';
                }
            }
            $this->putJson();
        }
    }
    function initiatedTask($id_task){
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
    function completedTask($id_task){
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