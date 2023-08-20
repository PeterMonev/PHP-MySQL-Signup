<?php

if(isset($_POST['signup'])){
    require_once("signupModel.php");
    $singup = new signupModel();
    $singup->setUsername($_POST['username']);
    $singup->setEmail($_POST['email']);
    $singup->setPassword($_POST['password']);
    $singup->setPhone($_POST['phone']);
}

if($singup->checkUser($_POST['email'])){
    echo '<script>alert("Email exist please!");document.location="signupView.php"</script>';
} else {
    $singup->insertData();
    echo '<script>alert("User Created");document.location="loginView.php"</script>';
}

?>