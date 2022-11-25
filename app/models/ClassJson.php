<?php




class Json{

    /*private $jsonFile = ("db/tasks.json");
    private function create (){

    }
    private function getRows(){
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData,true);
            if (!empty($data)) {
                usort($data, function ($a,$b){
                    return $b['id'] - $a['id'];
                });
            }
            return !empty($data)?$data:false; 
        } 
        return false; 
    
    }
    public function getSingle($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
        $singleData = array_filter($data, function ($var) use ($id) { 
            return (!empty($var['id']) && $var['id'] == $id); 
        }); 
        $singleData = array_values($singleData)[0]; 
        return !empty($singleData)?$singleData:false; 
    } 
     
    public function insert($newData){ 
        if(!empty($newData)){ 
            $id = time(); 
            $newData['id'] = $id; 
             
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            $data = !empty($data)?array_filter($data):$data; 
            if(!empty($data)){ 
                array_push($data, $newData); 
            }else{ 
                $data[] = $newData; 
            } 
            $insert = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $insert?$id:false; 
        }else{ 
            return false; 
        } 
    } 
    
     
    public function update($upData, $id){ 
        if(!empty($upData) && is_array($upData) && !empty($id)){ 
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            foreach ($data as $key => $value) { 
                if ($value['id'] == $id) { 
                    if(isset($upData['description'])){ 
                        $data[$key]['description'] = $upData['description']; 
                    } 
                    if(isset($upData['masterUsr_id'])){ 
                        $data[$key]['masterUsr_id'] = $upData['masterUsr_id']; 
                    } 
                    if(isset($upData['slaveUsr_id'])){ 
                        $data[$key]['slaveUsr_id'] = $upData['slaveUsr_id']; 
                    } 
                    if(isset($upData['initiated'])){ 
                        $data[$key]['initiated'] = $upData['initiated']; 
                    } 
                    if(isset($upData['done'])){ 
                        $data[$key]['done'] = $upData['done']; 
                    } 
                    if(isset($upData['currentStatus'])){ 
                        $data[$key]['currentStatus'] = $upData['currentStatus']; 
                    } 
                    if(isset($upData['deleted'])){ 
                        $data[$key]['deleted'] = $upData['deleted']; 
                    } 
                } 
            } 
            $update = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $update?true:false; 
        }else{ 
            return false; 
        } 
    } 
     
    public function delete($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
             
        $newData = array_filter($data, function ($var) use ($id) { 
            return ($var['id'] != $id); 
        }); 
        $delete = file_put_contents($this->jsonFile, json_encode($newData)); 
        return $delete?true:false; 
    } */

    function getTasks(){
        return json_decode(file_get_contents(__DIR__.'db/tasks.json'), true);
    }
    function getTaskbyID($id){
        $tasks= self::getTasks();
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }
        return null;
    }
    function createTask($data){
        $tasks= self::getTasks();
        $data['id'] = rand(1000000, 2000000);

        $tasks[] = $data;

        self::putJson($tasks);

        return $data;
    }
    function updateTask($data, $id){
        $updateTask = [];
        $tasks = self::getTasks();
        foreach ($tasks as $i => $task) {
        if ($task['id'] == $id) {
            $tasks[$i] = $updateTask = array_merge($task, $data);
        }
    }

    self::putJson($tasks);

    return $updateTask;

    }
    function deleteTask($id){

        $tasks = self::getTasks();

        foreach ($tasks as $i => $task) {
            if ($task['id'] == $id) {
                array_splice($tasks, $i, 1);
            }
        }
    
        self::putJson($tasks);
    }
    function putJson($tasks)
    {
        file_put_contents(__DIR__ . '/users.json', json_encode($tasks, JSON_PRETTY_PRINT));
    }

}


?>