<?php

if(isset($_POST['signup'])){
    require_once("signupModel.php");
    $singup = new signupModel();
    $singup->setUsername($_POST['username']);
    $singup->setEmail($_POST['email']);
    $singup->setPassword($_POST['password']);
    $singup->setPhone($_POST['phone']);
  
    $singup->insertData();

    echo 'done';

    echo '<script>alert("User CRETED");document.location="index.php"</script>';

}

?>