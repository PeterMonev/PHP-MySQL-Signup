<?php

require_once("dbConnect.php");


class ProfileModel {
    private $username;
    private $email;
    private $phone;

    protected $dbCnx;

    public function __construct($id=0, $username="", $email="", $phone=""){
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;

        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER,DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
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
            return $_SESSION['error_message'] = "Update Profile failed: " . $error->getMessage();
        }
    }

    public function getUserData($userId){
        try{
        $statement = $this->dbCnx->prepare("SELECT username, email, phone FROM users WHERE id=?");
        $statement->execute([$userId]);
        return $statement->fetch();
        } catch(PDOException $error) {
            return $_SESSION['error_message'] = "Update Profile failed: " . $error->getMessage();
        }
    }

    public function updateProfile($userId){
        try {
            $statement = $this->dbCnx->prepare("UPDATE users SET username=?, email=?, phone=? WHERE id=?");
            return $statement->execute([$this->username, $this->email, $this->phone, $userId]);
        } catch (PDOException $error) {
            return $_SESSION['error_message'] = "Update Profile failed: " . $error->getMessage();
        }
    }
}

?>
