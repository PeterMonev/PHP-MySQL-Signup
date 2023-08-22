<?php

session_start();
require_once('profileModel.php');

function getUserData(){
    if(!isset($_SESSION['id'])){
      // Redirect if not logged in
      header("Location: loginView.php");
      exit();
    }

    $model = new ProfileModel();
    $userData = $model->getUserData($_SESSION['id']);
    return $userData;
}

if(isset($_POST['update'])){
    $userData = getUserData(); 

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Backend validations
    if(empty($username) || empty($email) || empty($phone)){
        $_SESSION['error_message'] = 'All fields are required.';
        header("Location: profileView.php");
        exit();
    }

    // Check username field
    if(strlen($username) < 3){
        $_SESSION['error-message'] = 'Username must be at lest 3 characters';
        header('Location: profileView.php');
        exit();
    }

     // Validate email format
     $emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";

     if(!filter_var($email, FILTER_VALIDATE_EMAIL || !preg_match($emailRegex, $email))){
        $_SESSION['error_message'] = 'Invalid email format.';
        header("Location: profileView.php");
        exit();
    }

    //  regex validating Bulgarian phone numbers
     $phoneRegex = "/^(\+359|0)[0-9]{9}$/";

     if(!preg_match($phoneRegex, $phone)){
        $_SESSION['error_message'] = 'Invalid phone number format. You are phone number must be like: +359 XX XXX XXX';
        header("Location: profileView.php");
        exit();
    }


    $newProfile = new ProfileModel();
    $newProfile->setUsername($username);
    $newProfile->setEmail($email);
    $newProfile->setPhone($phone);

    if($userData['email'] === $email){
        $newProfile->updateProfile($_SESSION['id']); 
        $_SESSION['success_message'] = 'Update successful!';
        header("Location: profileView.php?showModal=true");
        exit();
    } else {
       // Check for existing email
       if($newProfile->checkUser($_POST['email'])){
        $_SESSION['error_message'] = 'Sorry, email already exist. Please try again with another.';
        header("Location: profileView.php?showModal=true");
        exit();
    } else {
        $newProfile->updateProfile($_SESSION['id']); 
        $_SESSION['success_message'] = 'Update successful!';
        header("Location: profileView.php?showModal=true");
        exit();
    } 


    }
}



?>