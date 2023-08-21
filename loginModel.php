<?php
require_once("dbConnect.php");

class LoginModel {

    private $id;
    private $email;
    private $password;
    protected $dbCnx;

    public function __construct($id=0, $email="", $password=""){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
  
        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER,DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }


    public function login(){
        try {
            $statement = $this->dbCnx->prepare("SELECT * FROM users WHERE email=?");
            $statement->execute([$this->email]);
            $user = $statement->fetchAll();
 
            if($user && password_verify($this->password, $user[0]['password'])){
                session_start();
                $_SESSION['id'] = $user[0]['id'];
        
                return true;
            } else {
                return false;
            }

            
       } catch (Exception $error){
            return $_SESSION['error_message'] = "Login failed: " . $error->getMessage();
       }
     }
} 

?>