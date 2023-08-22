<?php
include('./header.php');
require_once('profileController.php');

$userData = getUserData();

?>

<body>

<?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success text-center" role="alert"> '.
        $_SESSION['success_message'] . ' Update successful!</div>';
        unset($_SESSION['success_message']);
    } 
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Profile Page Information
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: <?php echo $userData['username']; ?></h5>
            <p class="card-text">Email: <?php echo $userData['email']; ?></p>
            <p class="card-text">Phone: <?php echo $userData['phone']; ?></p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal">Update Profile</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<!-- Modal Update Page -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Затвори"></button>
      </div>
      <div class="modal-body">
        <form action="profileController.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $userData['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $userData['phone']; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-success mt-3">Update changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
        setTimeout(function() {
            const alertDiv = document.querySelector('.alert');
            if (alertDiv) {
                alertDiv.style.display = 'none';
            }
        }, 2000);  // The alert will disappear after 2 seconds 
    </script>
</body>
