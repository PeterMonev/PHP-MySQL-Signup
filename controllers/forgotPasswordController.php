<?php
session_start();

try {
   
    require_once('../models/forgotPasswordModel.php');
    $reset = new forgotPasswordModel();

    // Send email for validation
    if (isset($_POST['reset-password'])) {
        $email = trim($_POST['email']);
        $success = $reset->sendResetLink($email);

        if(!$success) {
            $_SESSION['error_message'] = "This email doens't exits!";
            header('Location: ../views/forgotPasswordView.php');
            exit();
        }
    }

    // Reset password form
    if (isset($_POST['reset-password-submit'])) {
        $newPassword = trim($_POST['newPassword']);

        if (!isset($_GET['token'])) {
            throw new Exception('Token is missing!');
        }

        $token = $_GET['token'];
        if ($reset->resetPassword($token, $newPassword)) {
            $_SESSION['success_message'] = 'Change password successful!';
            header("Location: ../views/loginView.php");
            exit();
        } else {
            throw new Exception('Invalid token!');
        }
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../views/forgotPasswordView.php');
    exit();
}
?>
