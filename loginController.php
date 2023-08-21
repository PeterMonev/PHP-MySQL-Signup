 <?php

session_start();

// Check if the login form has been submitted.
if(isset($_POST['login'])){
    require_once('loginModel.php');

    // Backend Valdaiton
    $email= trim($_POST['email']);
    $password= trim($_POST['password']);

     // Check email if empty are empty or it has a valid format
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid password or email!';
        header('Locate: loginView.php'); // Redirect to login page
        exit();
    }

    // Check password is empty 
    if(empty($password) || strlen($password) < 8){
        $_SESSION['error_message'] = 'Invalid password or email!';
        header('Locate: loginView.php'); // Redirect to login page
        exit();
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

}

?>