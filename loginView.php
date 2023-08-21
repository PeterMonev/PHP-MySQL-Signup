<?php 
include('./header.php'); 
session_start();
?>

<body>
    <!-- Successful and Alert message -->
    <?php 
    if(isset($_SESSION['success_message'])){
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    } 
    
    if(isset($_SESSION['error_message'])){
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div class="container mt-5">
        <h2>Login</h2>
        <form action="loginController.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"  required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <div class="form-group">
                <label for="route">You already don't have account? Go to Sign Up.</label>  
                <a href="signupView.php">Sign Up</a>
            </div>
        </form>
    </div>

</body>


