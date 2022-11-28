<?php




class JsonModel{

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
        if($this->number_of_records != 0){
            foreach ($this->tasks as $task) {
                array_push($this->setTaskId, $task['id']);
                array_push($this->tasks, $task["created_at"]);
                array_push($this->tasks, $task["currentStatus"]);
                array_push($this->tasks, $task["masterUsr_id"]);
                array_push($this->tasks, $task["slaveUsr_id"]);
                array_push($this->tasks, $task["initiated"]);
                array_push($this->tasks, $task["done"]);
                array_push($this->tasks, $task["deleted"]);

            }
        }
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
    function getTaskbyID($id){
        $tasks= $this->getTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }
        return null;
    }
    
    public function createTask(array $new_task){
        $taskWithId = $this->setTaskId($new_task);
        array_push($this->tasks, $taskWithId);
   
        /* task validation */
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
            else{
              return false;
           }
        }
     }
    function updateTask($id){
        foreach($this->tasks as $task => $id){
            if($task['id'] == $id){ 
               $this->tasks[$task]['id'] = $id;
                if ($id['id'] == $id){ 
                    if(!empty($this->tasks) && is_array($this->tasks) && !empty($id)){ 
                        if(isset($this->tasks['description'])){ 
                            $this->tasks[$task]['description'] = $this->description; 
                        } 
                        if(isset($this->tasks['masterUsr_id'])){ 
                            $this->tasks[$task]['masterUsr_id'] = $this->masterUsr_id; 
                        } 
                        if(isset($this->tasks['slaveUsr_id'])){ 
                            $this->tasks[$task]['slaveUsr_id'] = $this->slaveUsr_id; 
                        } 
                        if(isset($this->tasks['initiated'])){ 
                            $this->tasks[$task]['initiated'] = $this->initiated; 
                        } 
                        if(isset($this->tasks['done'])){ 
                            $this->tasks[$task]['done'] = $this->done; 
                        } 
                        if(isset($this->tasks['currentStatus'])){ 
                            $this->tasks[$task]['currentStatus'] = $this->currentStatus; 
                        } 
                        if(isset($this->tasks['deleted'])){ 
                            $this->tasks[$task]['deleted'] = $this->deleted; 
                        }
                 
                    } 
             
                }
                return $task;        
            }
        }
    }

    function deleteTask($id){

        foreach($this->tasks as $task => $value){
            if($value['id'] == $id){
               unset($this->tasks[$task]);
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