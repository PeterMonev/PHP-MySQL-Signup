<?php
require_once("dbConnect.php");

class signupModel {
    private $id;
    private $username;
    private $email;
    private $password;
    private $phone;
    protected $dbCnx;

    public function __construct($id=0, $username="", $email="", $password="", $phone=""){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;

        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER,DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this-> username;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function checkUser($email){
        try{
            $statement = $this->dbCnx->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(":email", $email);
            $statement->execute();
            
            if($statement->fetchColumn()){
                return true;
            } else {
                return false;
            }

        } catch (Exception $error) {
            return $_SESSION['error_message'] = "Registration failed: " . $error->getMessage();
        }
    }

    public function insertData(){
        try{
            echo $this->getUsername();
            $statement = $this->dbCnx->prepare("INSERT INTO users(username, email, password, phone) values(?,?,?,?)");
            $statement->execute([$this->username,$this->email,$this->password,$this->phone]);
      
        } catch(PDOException $error){
            return $_SESSION['error_message'] = "Registration failed: " . $error->getMessage();
        }
    }
}


?>