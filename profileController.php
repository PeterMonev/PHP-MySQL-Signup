<?php

session_start();
require_once('profileModel.php');

class ValidationException extends Exception {}

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
    try {
        $userData = getUserData(); 

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        // Backend validations
        if(empty($username) || empty($email) || empty($phone)){
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

        // regex validating Bulgarian phone numbers
        $phoneRegex = "/^(\+359|0)[0-9]{9}$/";
        if(!preg_match($phoneRegex, $phone)){
            throw new ValidationException('Invalid phone number format. Your phone number must be like: +359 XX XXX XXX');
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
            if($newProfile->checkUser($email)){
                throw new ValidationException('Sorry, email already exists. Please try another.');
            } else {
                $newProfile->updateProfile($_SESSION['id']); 
                $_SESSION['success_message'] = 'Update successful!';
                header("Location: profileView.php?showModal=true");
                exit();
            } 
        }

    } catch (ValidationException $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: profileView.php?showModal=true");
        exit();
    }
}

?>
