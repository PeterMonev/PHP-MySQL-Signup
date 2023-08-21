<?php 
include('./header.php');
session_start(); ?>

<body>
  
<!-- Successful and Alert message -->
<?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-primary" role="alert"> '.
        $_SESSION['success_message'] . ' <a href="loginView.php" class="alert-link">Login here</a></div>';
        unset($_SESSION['success_message']);
    } elseif (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
?>

    <div class="container mt-5">
        <h2>Signup Form</h2>
        <form action="signupController.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="form-group">
                <label for="repeatPassword">Repeat Password:</label>
                <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat password" name="repeatPassword">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phone">
            </div>
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            <div class="form-group">
                <label for="route">You already have an account? Go to login.</label>  
                <a href="loginView.php">Login</a>
            </div>
        </form>
    </div>
    <script>
        setTimeout(function() {
            const alertDiv = document.querySelector('.alert-danger');
            if (alertDiv) {
                alertDiv.style.display = 'none';
            }
        }, 3000);  // The alert will disappear after 5 seconds 
    </script>
</body>

