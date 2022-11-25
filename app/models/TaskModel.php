<?php
require_once ("lib/base/Model.php");
class TaskModel{

private int $_id;
private string $_description;
private $_created_at = date("Y-m-d H:i:s");
private $_initiated = date("Y-m-d H:i:s");
private $_done = date("Y-m-d H:i:s");
private $_currentStatus_id;
private $_deleted= False;
private $_masterUsr_id;
private $_slaveUsr_id;
private $Task;
private $db;
private $data = "'" .$this->_id. "','".$this->_slaveUsr_id . "','". $this->_masterUsr_id. "','". $this->_currentStatus_id. "','". $this->_done. "','". $this->_initiated. "','". $this->_created_at. "','". $this->_description."'"; 

public function __construct()
{
    $this->Task = array();
    $this->db = new PDO ('mysql:host=localhost;dbname=developers_mysql',"root","");
    
}
public function getTask(){
    return $this->_Task;
}
public function getDb(){
    return $this->_db;
}

public function getMasterUsrId(){
    return $this->_masterUsr_id;
}
public function getSlaveUsrId(){
    return $this->_slaverUsr_id;
}
public function getDeleted(){
    return $this->_deleted;
}
public function getCurrentStatusId(){
    return $this->_currentStatus_id;
}
public function getId(){
    return $this->_Id;
}
public function getDescription(){
    return $this->_description;
}
public function getCreatedAt(){
    return $this->_created_at;
}
public function getInitiated(){
    return $this->_initiated;
}
public function getDone(){
    return $this->_done;
}
public function setTask($Task){
    $this->Task= $Task;
}
public function setDb($db){
    $this->db= $db;
}

public function setCurrentStatus($_currentStatus_id){
    $this->_currentStatus_id= $_currentStatus_id;
}
public function setId($_id){
    $this->_id= $_id;
}
public function setDescription($_description){
    $this->_description= $_description;
}
public function setcreatedAt($_created_at){
    $this->_created_at= $_created_at;
}
public function setInitiated($_initiated){
    $this->_initiated= $_initiated;
}
public function setDone($_done){
    $this->_done= $_done;
}
public function setMasterUsrId($_masterUsr_id){
    $this->_masterUsr_id= $_masterUsr_id;
}
public function setSlaveUsrId($_slaveUsr_id){
    $this->_slaveUsr_id= $_slaveUsr_id;
}
public function setDeleted($_deleted){
    $this->_deleted = $_deleted;
}


public function add($tasks, $data){
    $consult = "INSERT INTO" .$tasks. " values(".$data.")";
    $result= $this->db->query($consult);
    if ($result) {
        return $result;
    }else {
        return false;
    }
    
}

public function show($tasks, $condition){
    $consult = "SELECT * FROM ".$tasks. " WHERE ".$condition.";";
    $result = $this->db->query($consult);
    while($row = $result->fetchAll(PDO::FETCH_ASSOC)){
        $this->tasks[]= $row;
    }
    return $this->tasks;
}
public function update ($tasks, $data, $condition ){
    $consult = "UPDATE " .$tasks. " SET ".$data. " WHERE ".$condition ;
    $result = $this->db->query($consult);
    if ($result) {
       return $result;
    }else {
        return false;
    }
    
}

public function delete($tasks, $condition){
    $consult = "DELETE FROM ".$tasks ." WHERE ".$condition;
    $result = $this->db->query($consult);
    if ($result) {
        return true;
    }else {
        return false;
    }
    
}
   

}

?>