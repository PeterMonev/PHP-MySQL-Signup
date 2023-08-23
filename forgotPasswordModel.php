<?php
require_once('./database/dbConnect.php');

class forgotPasswordModel {

    protected $dbCnx;

    public function __construct(){
        $this->dbCnx = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD, [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function sendResetLink($email) {
        // Check if email exists
        $statement = $this->dbCnx->prepare("SELECT * FROM users WHERE email=?");
        $statement->execute([$email]);
        $user = $statement->fetch();
    
        if(!$user){
            return false; // Return false if email doesn't exist
        }
    
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
    
        // Store token in database
        $stmt = $this->dbCnx->prepare("INSERT INTO password_reset(email, token) VALUES(?, ?)");
        $stmt->execute([$email, $token]);
    
        // Send token to user email
        $this->sendEmail($email, $token);
    
        return true;
    }
    
    private function sendEmail($email, $token) {
        $subject = "Password Reset";
        $body = "Click here to reset your password: http://localhost/signup/resetPasswordView.php?token=".$token;
        mail($email, $subject, $body);
    }

    public function resetPassword($token, $newPassword){
        // Check token validity
        $statement = $this->dbCnx->prepare("SELECT email FROM password_reset WHERE token=?");
        $statement->execute([$token]);
        $email = $statement->fetchColumn();
    
        if($email){
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->dbCnx->prepare("UPDATE users SET password=? WHERE email=?");
            $stmt->execute([$hashedPassword, $email]);
    
            $_SESSION['success_message'] = "Password reset successfully!";
        } else {
            $_SESSION['error_message'] = "Invalid token!";
        }
    }
}
?>
