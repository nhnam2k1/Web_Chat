<?php
    $phpPath = "php/";
    $mainPath = "";
    $configPath = "$phpPath"."Config";

    include_once("$configPath/Session.php");
	include_once("$configPath/SessionEnd.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Profile</title>
</head>
<body>
    <?php include("$phpPath/header.php"); ?>
    <div id="row">
        <div class="column">
            <form action="" id="Profile-card">
                <h1>Profile Card</h1>
                <div class="textbox">
                    <label>
                        Name:
                        <b id="Name">Nhat Nam Ha</b>
                    </label>
                </div>
                <div class="textbox">
                    <label>
                        Gender:
                        <b id="Gender">Male</b>
                    </label>
                </div> 
                <div class="textbox">
                    <label>
                        Birthdate:
                        <b id="Birthdate">12/01/2001</b>
                    </label>
                </div>
                <div class="textbox">
                    <label>
                        Email:
                        <b id="Email">n@gmail.com</b>
                    </label>
                </div>
            </form>
        </div>
        <div class="column">
            <form action="" id="Profile-edit">
                <h1>Profile Edit</h1>
                <div class="textbox">
                    <label>
                        New email:
                        <input type="email" name="email" id="email" placeholder="example@email.com">
                    </label>
                </div>
                <div class="textbox">
                    <label>
                        New password:
                        <input type="password" name="password" id="password" placeholder="Password">
                    </label>
                </div>
                <div class="textbox">
                    <label>
                        Re-password:
                        <input type="password" name="confirmPassword" id="coonfirmPassword" placeholder="Confirm Password">
                    </label>
                </div>
                <button type="submit">Edit Profile</button>
            </form>
        </div>
    </div>
    <?php include("$phpPath/footer.php"); ?>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/validateInput.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>