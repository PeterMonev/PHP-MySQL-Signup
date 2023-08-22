 <?php

session_start();

class ValidationException extends Exception{}

// Check if the login form has been submitted.
if(isset($_POST['login'])){
    require_once('loginModel.php');

    try{
    // Backend Valdaiton
    $email= trim($_POST['email']);
    $password= trim($_POST['password']);

     // Check email if empty are empty or it has a valid format
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new ValidationException('Invalid email format.');
    }

    // Check password is empty 
    if(empty($password) || strlen($password) < 8){
        throw new ValidationException('Password is either empty or less than 8 characters.');
    }

    $userInfo = new LoginModel(); // Create an instance of the LoginModel class
    $userInfo->setEmail($_POST['email']);
    $userInfo->setPassword($_POST['password']);

    $login = $userInfo->login(); // Check the credentials against the database

    if($login){
        $_SESSION['success_message'] = 'Login succesful!'; // If credentials are valid.
        header("Location:profileView.php");  // Redirect to Profile page
        exit();
    } else {
        $_SESSION['error_message'] = 'Invalid password or email!';
        header('Location: loginView.php');
        exit();
    }

    } catch (ValidationException $e) {
         $_SESSION['error_message'] = $e->getMessage();
         header('Location: loginView.php');
         exit();
    }
}

?>