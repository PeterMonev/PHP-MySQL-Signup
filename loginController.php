 <?php

session_start();
if(isset($_POST['login'])){
    require_once('loginModel.php');

    $info = new LoginModel();
    $info->setEmail($_POST['email']);
    $info->setPassword($_POST['password']);

    $login = $info->login();
    if($login){
        header("Location:profileView.php");

    } else {
        
    echo '<script>alert("Invalid Email or Password");</script>';
    }

}

?>