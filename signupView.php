<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>

    <!-- Bootstrap JS and jQuery -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

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
            <button type="submit" name="signup" class="btn btn-primary">Signup</button>
        </form>
    </div>
.
</body>

</html>