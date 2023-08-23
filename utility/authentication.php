<?php 
// Authentication check
if(!isset($_SESSION['id'])){
   header('Location: ../views/loginView.php');
   exit();
}

?>