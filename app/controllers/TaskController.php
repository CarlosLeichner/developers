<?php
require_once("app/TaskModel.php");
class TaskController{

    private $taskModel;
    public function __construct(){
        $this->taskModel= new TaskModel();
    }
    //mostrar
    public function show(){
        $_id = $_REQUEST['id'];
        $task = new TaskModel();
        $show = $task->show("tasks", "id=.$_id");
        return $show;
        
    }
    public function add(){
        $_id = $_REQUEST ['id'];
        $_description = $_REQUEST ['description'];
        $_created_at = $_REQUEST [ date("Y-m-d H:i:s")];
        $_initiated = $_REQUEST [ date("Y-m-d H:i:s")];
        $_done = $_REQUEST [ date("Y-m-d H:i:s")];
        $_currentStatus_id= $_REQUEST ['description'];
        $_masterUsr_id = $_REQUEST ['MasterID'];
        $_slaveUsr_id= $_REQUEST ['SlaveID'];
        
        $data = "'" .$_id. "','".$_slaveUsr_id . "','". $_masterUsr_id. "','". $_currentStatus_id. "','". $_done. "','". $_initiated. "','". $_created_at. "','". $_description."'";
        $task = new TaskModel();
        $add = $task->add("tasks", $data);
        if($add){
            return $add;
        }else {
            return false;
        }
        

    }
    public function update(){

        $_id= $_REQUEST['id'];
        $_description = $_REQUEST ['description'];
        $_created_at = $_REQUEST [ date("Y-m-d H:i:s")];
        $_initiated = $_REQUEST [ date("Y-m-d H:i:s")];
        $_done = $_REQUEST [ date("Y-m-d H:i:s")];
        $_currentStatus_id= $_REQUEST ['description'];
        $_masterUsr_id = $_REQUEST ['MasterID'];
        $_slaveUsr_id= $_REQUEST ['SlaveID'];
        $data = "'" .$_id. "','".$_slaveUsr_id . "','". $_masterUsr_id. "','". $_currentStatus_id. "','". $_done. "','". $_initiated. "','". $_created_at. "','". $_description."'";

        $condition = "id=.$_id";
        $task = new TaskModel();
        $update = $task->update("tasks", $data, $condition);
        if($update){
            return $update;
        }else {
            return false;
    }
    
}
    public function delete (){

        $_id= $_REQUEST['id'];
        $condition = "id=.$_id";
        $task = new TaskModel();
        $delete = $task->delete("tasks", $condition);
        if($delete){
            return true;
        }else {
            return false;
        }
        
    }

}

?>