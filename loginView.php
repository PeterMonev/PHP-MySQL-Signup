<?php 
include('./header.php');
session_start();


?>

<body>
    <!-- Successful and Alert message -->
    <?php 
    if(isset($_SESSION['success_message'])){
        echo '<div class="alert alert-success text-center" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    } 
    
    if(isset($_SESSION['error_message'])){
        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div class="container mt-5 p-4 text-center w-50 shadow-lg rounded">
        <h2>Login</h2>
        <form id="loginForm" action="loginController.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"  required>
            </div>
            <button type="submit" name="login" id="submit" class="btn btn-primary">Login</button>
            <div class="form-group my-3">
                <label for="route">You already don't have account? Go to Sign Up.</label>  
                <a href="./signupView.php" class="pb-4">Sign Up</a>
                <div  class="container p-2"> <a href="./forgotPasswordView.php">Forgot Password?</a></div>
               
            </div>
        </form>
    </div>
    <script src="./utility/validation.js"></script>
    <script>
        setTimeout(function() {
            const alertDiv = document.querySelector('.alert-danger');
            if (alertDiv) {
                alertDiv.style.display = 'none';
            }
        }, 3000);  // The alert will disappear after 3 seconds 
    </script>
</body>


