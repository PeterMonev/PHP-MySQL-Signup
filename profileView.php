<?php 
include('./header.php'); 
require_once("loginModel.php");
session_start();

if(!isset($_SESSION['id'])){
    header('Location: loginView.php'); // Redicert to login page
    exit();
}
?>

<?php 

var_dump($_SESSION);
?>



<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Profile Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: <?php echo $_SESSION['username']; ?></h5>
            <p class="card-text">Email: <?php echo $_SESSION['email']; ?></p>
            <p class="card-text">Password: ********** </p>
            <p class="card-text">Phone: <?php echo $_SESSION['phone']; ?></p>
            <a href="#" class="btn btn-primary">Update Profile</a>
            <a href="#" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

</body>