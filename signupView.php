<?php include('./header.php'); ?>

<body>
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
</body>

