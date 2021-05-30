<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Registration</title>
</head>
<body>
    <form action="" method="POST" id="registration-form" onsubmit="">
        <h1>Registration</h1>
        <div class="textbox">
            <label>
                First Name 
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Last Name 
                <input type="text" name="lname" id="lname" placeholder="Last Name" required>
            </label>
        </div>
        <div class="textbox">
                Gender
                <label>
                    Male 
                    <input type="radio" name="gender" id="male" value="male" checked>
                </label>
                <label>
                    Female 
                    <input type="radio" name=gender id="female" value="female">
                </label>
        </div>
        <div class="textbox">
            <label>
                Birthdate
                <input type="date" name="birthdate" id="birthdate" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Email
                <input type="email" name="email" id="email" placeholder="example@email.com" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Username
                <input type="text" name="username" id="username" placeholder="usernname" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Password
                <input type="password" name="password" id="password" placeholder="password" required>
            </label>
        </div>
        <div class="textbox">
            <label>
                Re-password
                <input type="password" name="confirmPassword" id="coonfirmPassword" placeholder="Confirm Password" required>
            </label>
        </div>
        <button type="submit">Register</button>
        <a href="login.php">
            <button type="button">Back to Login</button>
        </a>
    </form>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/validateInput.js"></script>
    <script src="js/registration.js"></script>
</body>
</html>