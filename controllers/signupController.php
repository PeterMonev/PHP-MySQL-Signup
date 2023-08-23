<?php
session_start();

class ValidationException extends Exception {}

// Check if the register form has been submitted.
if(isset($_POST['signup'])){
    require_once("../models/signupModel.php");

    try {
        // Backend Validation
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $repeatPassword = trim($_POST['repeatPassword']);
        $phone = trim($_POST['phone']);

        // Check if fields are not empty
        if(empty($username) || empty($email) || empty($password) || empty($phone)){
            throw new ValidationException('All fields are required.');
        }

        // Check username field
        if(strlen($username) < 3){
            throw new ValidationException('Username must be at least 3 characters.');
        }

        // Validate email format
        $emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";

        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match($emailRegex, $email)){
            throw new ValidationException('Invalid email format.');
        }

        // Check if passwords match
        if($password !== $repeatPassword){
            throw new ValidationException('Passwords do not match.');
        }

        // Validate password length
        if(strlen($password) < 8){
            throw new ValidationException('Password must be at least 8 characters.');
        }

        // regex validating Bulgarian phone numbers
        $phoneRegex = "/^(\+359|0)[0-9]{9}$/";

        if(!preg_match($phoneRegex, $phone)){
            throw new ValidationException('Invalid phone number format. Your phone number must be like: +359 XX XXX XXX');
        }

        $signup = new signupModel();
        $signup->setUsername($username);
        $signup->setEmail($email);
        $signup->setPassword($password);
        $signup->setPhone($phone);
          
        // Check for existing email
        if($signup->checkUser($email)){
            throw new ValidationException('Sorry, email already exists. Please try another.');
        } else {
            $signup->insertData(); 
            $_SESSION['success_message'] = 'Registration successful!';
            header("Location: ../views/signupView.php");
            exit();
        }

    } catch (ValidationException $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../views/signupView.php");
        exit();
    }
}
?>
