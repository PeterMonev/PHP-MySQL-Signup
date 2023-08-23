<?php
session_start();
include('./header.php');

if(isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger text-center">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}

if(isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
?>

<body>
    
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Password Recovery</div>
                <div class="card-body">
                    <form action="forgotPasswordController.php" method="post">
                        <div class="form-group">
                            <label for="email">Enter your email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" name="reset-password" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        setTimeout(function() {
            const alertDiv = document.querySelector('.alert-danger');
            if (alertDiv) {
                alertDiv.style.display = 'none';
            }
        }, 3000);  // The alert will disappear after 3 seconds 
    </script>
</body>
