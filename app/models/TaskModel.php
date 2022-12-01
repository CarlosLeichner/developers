<?php




class Task {

    private $_jsonFile; 
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
        if (!file_exists(ROOT_PATH.'../db/tasks.json')) {
            $this->_jsonFile = $this->putJson('[]');
        }else {
            $this->_jsonFile = $this->getJson();
        }
        
        $this->arrTask = array (
            'id_task' => $this->setTaskId(),
            'created_at' =>  date("Y-m-d H:i:s"),
            'description' => '',
            'currentStatus' => 'created',
            'done' =>  date("Y-m-d H:i:s"),
            'initialized' =>  date("Y-m-d H:i:s"),
            'deleted' => false,
            'masterUsr_id'=>'',
            'slaveUsr_id'=>''
        );
        
    }
    private function setTaskId($data){
        $data = $this->arrTask;
        $id_task=0;
        $this->arrTask = $this->getTasks();
        foreach ($data as $key => $value) {
            if($value == "id_task"){
                if ($id_task == 0){
                    $id_task = +1;
                }
            }
        }return $data;
        
    }
    function getTasks(){
        
        return $this->getJson();
    }
    function getTaskbyID($id_task){
        
        $tasks = $this->getTasks();
        //echo $tasks;
        if (is_array($tasks)){
            foreach ($tasks as $task) {
                if ($task['id_task'] == $id_task) {
                    //echo $tasks[$key];
                    return $task;
                }
            }return null;
        }
        
    }
    function getId($id_task){
        
        $tasks = $this->arrTask;
        //echo $tasks;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if ($value['id_task'] == $id_task) {
                    //echo $tasks[$key];
                    return $key[$id_task];
                }
            }
        } 
    }
    public function createTask($arrTask){
        
        $tasks = $this->getTasks();
        $arrTask ['id_Task'] = $this->setTaskId();
        $this->putJson ($tasks);
        return $arrTask;
        // $tasks = $this->putJson($tasks);
        // var_dump($tasks);
        // exit;
        
        // if($this->arrTask['id_task']===0){
        //    $this->putJson($tasks);
        // }else{
        //     if(!in_array($this->arrTask['currentStatus'], ['created'])){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['initiated'], $initiated)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['created_at'], $created_at)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['description'], $description)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['done'], $done)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['masterUsr_id'], $masterUsr_id)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['slaveUsr_id'], $slaveUsr_id)){
        //         $this->putJson($tasks);
        //     }
        //     if(!in_array($this->arrTask['deleted'], $deleted)){
        //         $this->putJson($tasks);
        //     }
            
        
    }
    public function updateTask($id_task, $slaveUsr_id, $masterUsr_id, $description ,$created_at, $initiated, $done, $deleted, $currentStatus){
        
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id_task'] === $id_task){ 
                $tasks[$value]['id_task'] = $id_task;
                    if ($value['id_task'] === $id_task){ 
                        if(!empty($tasks) && is_array($tasks) && !empty($id_task)){ 
                            if(isset($tasks['description'])){ 
                                $tasks[$key]['description'] = 'description'; 
                                $this->putJson($tasks);
                            } 
                            
                            if(isset($tasks['initiated'])){ 
                                $tasks[$key]['initiated'] = 'initiated'; 
                                $this->putJson($tasks);
                            } 
                            if(isset($tasks['done'])){ 
                                $tasks[$key]['done'] = 'done'; 
                                $this->putJson($tasks);
                            } 
                            if(isset($tasks['currentStatus'])){ 
                                $tasks[$key]['currentStatus'] = 'currentStatus'; 
                                $this->putJson($tasks);
                            } 
                            if(isset($tasks['deleted'])){ 
                                $tasks[$key]['deleted'] = 'deleted';
                                $this->putJson($tasks); 
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
                    $key[$value]['currentStatus'] = 'deleted';
                    $key[$value]['deleted'] = true;
                }
            }
            $this->putJson($tasks);
        }
    }
    public function initiatedTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id'] === $id_task){
                $key[$value]['currentStatus'] = 'initiated';
                $key[$value]['initiated'] = date("Y-m-d H:i:s");
                }
            }
            $this->putJson($tasks);
        }
    }
    public function completedTask($id_task){
        $tasks = $this->arrTask;
        if (is_array($tasks)){
            foreach ($tasks as $key =>$value) {
                if($value['id'] === $id_task){
                $key[$value]['currentStatus'] = 'completed';
                $key[$value]['done'] = date("Y-m-d H:i:s");
                }
            }
         $this->putJson($tasks);
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
    
    private function putJson($tasks)
    {
    json_decode(file_put_contents(ROOT_PATH. 'tasks.json', $tasks));
        
    }
    private function getJson()
    {
    json_decode(file_get_contents(ROOT_PATH. 'tasks.json', true ,JSON_PRETTY_PRINT));
        
    }
}


?>