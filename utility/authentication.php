<?php 
// Authentication check
if(!isset($_SESSION['id'])){
   header('Location: loginView.php');
   exit();
}

?>