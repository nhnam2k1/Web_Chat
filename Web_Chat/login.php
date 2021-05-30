<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST" id="login-form" onsubmit="">
        <h1>Login</h1>
        <div class="textbox">
            <label>
                Username
                <input type="text" name="Username" id="username" placeholder="username" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Password
                <input type="password" name="Password" id="password" placeholder="password" required>
            </label>
        </div>
        <div>
            <button type="submit">Sign in</button>
        </div>
        <div>
            <a href="registration.php">
                <button type="button">Register User</button>
            </a>
        </div>
    </form>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/validateInput.js"></script>
    <script src="js/login.js"></script>
</body>
</html>