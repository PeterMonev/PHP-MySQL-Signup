<?php
session_start();

// Check if the register form has been submitted.
if(isset($_POST['signup'])){
    require_once("signupModel.php");

    // Backend Validation
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeatPassword']);
    $phone = trim($_POST['phone']);

     // Check if fields are not empty
    if(empty($username) || empty($email) || empty($password) || empty($phone)){
        $_SESSION['error_message'] = 'All fields are required.';
        header("Location: signupView.php");
        exit();
    }

     // Validate email format
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['error_message'] = 'Invalid email format.';
        header("Location: signupView.php");
        exit();
    }

    // Passwords match
    if($password !== $repeatPassword){
        $_SESSION['error_message'] = 'Passwords do not match.';
        header("Location: signupView.php");
        exit();
    }

    // Validate password length
    if(strlen($password) < 8){
        $_SESSION['error_message'] = 'Password must be at least 8 characters.';
        header("Location: signupView.php");
        exit();
    }
   
    // A simple regex for validating Bulgarian phone numbers
    $pattern = "/^(\+359|0)[0-9]{9}$/";

    if(!preg_match($pattern, $phone)){
    $_SESSION['error_message'] = 'Invalid phone number format. You are phone number must be like: +359 XX XXX XXX';
    header("Location: signupView.php");
    exit();
    }

    
    $singup = new signupModel();
    $singup->setUsername($_POST['username']);
    $singup->setEmail($_POST['email']);
    $singup->setPassword($_POST['password']);
    $singup->setPhone($_POST['phone']);
      
    // Check for existing email
    if($singup->checkUser($_POST['email'])){
        $_SESSION['error_message'] = 'Sorry, email already exist. Please try again another.';
        header("Location: signupView.php");
        exit();
    } else {
        $singup->insertData(); 
        $_SESSION['success_message'] = 'Registretion successful!';
        header("Location: signupView.php");
        exit();
    }
}
