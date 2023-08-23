<?php 
session_start();
include('../shared/header.php');

$token = isset($_GET['token']) ? $_GET['token'] : ''; // Get the token from the URL

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
                <div class="card-header">Password Recovery Form</div>
                <div class="card-body">
                    <form action="../controllers/forgotPasswordController.php" method="post">
                        <!-- Hidden input field for the token -->
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                        <div class="form-group">
                            <label for="newPassword">New password:</label>
                            <input type="password" name="newPassword" id="newPassword" class="form-control" required>
                        </div>
                        <button type="submit" name="reset-password-submit" class="btn btn-primary">Save new password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../utility/validation.js"></script>
<script>
        setTimeout(function() {
            const alertDiv = document.querySelector('.alert-danger');
            if (alertDiv) {
                alertDiv.style.display = 'none';
            }
        }, 3000);  // The alert will disappear after 3 seconds 
    </script>

</body>