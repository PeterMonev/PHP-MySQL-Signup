<?php

require_once("./database/dbConnect.php");

class ProfileModel {
    private $username;
    private $email;
    private $phone;
    protected $dbCnx;

    public function __construct($username="", $email="", $phone="") {
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;

        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function checkUser($email) {
        try {
            $statement = $this->dbCnx->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(":email", $email);
            $statement->execute();
            
            return $statement->fetchColumn() ? true : false;
            
        } catch (PDOException $error) {
            throw new Exception("Error checking user: " . $error->getMessage());
        }
    }

    public function getUserData($userId) {
        try {
            $statement = $this->dbCnx->prepare("SELECT username, email, phone FROM users WHERE id=?");
            $statement->execute([$userId]);
            return $statement->fetch();
        } catch (PDOException $error) {
            throw new Exception("Error fetching user data: " . $error->getMessage());
        }
    }

    public function updateProfile($userId) {
        try {
            $statement = $this->dbCnx->prepare("UPDATE users SET username=?, email=?, phone=? WHERE id=?");
            $statement->execute([$this->username, $this->email, $this->phone, $userId]);
        } catch (PDOException $error) {
            throw new Exception("Error updating profile: " . $error->getMessage());
        }
    }

    public function verifyCurrentPassword($userId, $password){
        try {
            $statement = $this->dbCnx->prepare("SELECT password FROM users WHERE id=?");
            $statement->execute([$userId]);
            $hashedPassword = $statement->fetchColumn();
            
            return password_verify($password, $hashedPassword);
        } catch (PDOException $error) {
            throw new Exception("Error updating profile: " . $error->getMessage());
        }
    }

    public function updatePassword($userId, $newPassword){
        try {
            $hashedPassword =password_hash($newPassword,  PASSWORD_BCRYPT);
            $statement = $this->dbCnx->prepare("UPDATE users SET password=? WHERE id=?");
            $statement->execute([$hashedPassword, $userId]);
        } catch (PDOException $error) {
            throw new Exception("Error updating password: " . $error->getMessage());
        }
    }
}

?>
