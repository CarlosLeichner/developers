<?php

class User{

    private int $_id_user;
    private int $_id_master; //Senior.
    private int $_id_slave; //junior.
    private string $_name_user;
    

    private function __construct($_id_master,$_id_slave,$_id_user,$_name_user){

        $this -> _id_master = $_id_master;
        $this -> _id_slave = $_id_slave;
        $this -> _id_user = $_id_user;
        $this -> _name_user = $_name_user;
        
        
    }

    private function set_id_user($_id_user){
        $this -> _id_user = $_id_user;
    }

    private function set_id_master($_id_master){
        $this -> _id_master = $_id_master;
    }

    private function set_id_slave($_id_slave){
        $this -> _id_slave = $_id_slave;
    }

    private function set_name_master($_name_user){
        $this -> _name_user = $_name_user;
    }

    
    private function get_id_user(){
        return $this -> _id_user;
    }

    private function get_id_master(){
        return $this -> _id_master;
    }

    private function get_id_slave(){
        return $this -> _id_slave;
    }

    private function get_name_user(){
        return $this -> _name_user;
    }

}

class Password{
    
    const ALPHANUMERIC		= 0;
    const NUMBERS_ONLY		= 1;
    const ALPHABETIC_ONLY	= 2;

    private $password;
    private $salt;
    private $hash;

    public function __construct($password = NULL)
    {
        if($password != NULL){
            $this->password = $password;
            $this->salt();
            $this->hash();
        }
    }
    private function salt()
    {
        $this->salt = hash('sha256', $this->GenerateUniqueId(256));	
    }
    private function hash()
    {
        $this->hash = hash('sha256', $this->salt.$this->password);	
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;	
    }

    public function setHash($hash)
    {
        $this->hash = $hash;	
    }

    public function getSalt()
    {
        return $this->salt;	
    }

    public function getHash()
    {
        return $this->hash;	
    }

    public function verify($password)
    {
        return ($this->hash === hash('sha256',$this->salt.$password));	
    }

    public static function validate($password,$hash,$salt){
        $p = new Password;
        $p->setSalt($salt);
        $p->setHash($hash);
        return $p->verify($password);	
    }

    public function GenerateUniqueId($nbrOfChar, $prefix = '', $typeOfChar = self::ALPHANUMERIC) 
    {
        srand((double)microtime()*rand(1000000,9999999));

        $arrChar = array();
        $uId = $prefix; 

        if ($typeOfChar != self::NUMBERS_ONLY) {
            for ($i = 65; $i < 90; $i++) {
                array_push($arrChar,chr($i)); 				// Add A-Z to array
                array_push($arrChar,strtolower(chr($i))); 	// Add a-z to array
            }
        }

        if ($typeOfChar != self::ALPHABETIC_ONLY) {
            for ($i = 48; $i < 57; $i++) {
                array_push($arrChar,chr($i)); 				// Add 0-9 to array
            }
        }

        for ($i = 0; $i < $nbrOfChar; $i++) {
            $uId .= $arrChar[rand(0,count($arrChar)-1)];
        }

        return $uId;
    }
}
?>