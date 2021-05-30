<?php
    $mainPath = "";
    $phpPath = "php/";
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
        <link rel="stylesheet" type="text/css" href="css/chat.css">
        <title>Webchat</title>
    </head>
    <body>
        <div id="header-container">
            <?php include("$phpPath/header.php") ?>
        </div>
        <div id="page-container">
            <div id="home-title">
                <h1>
                    WEBCHAT
                </h1>
                <div id="logo-container">
                    <img id="logo" src="img/logo.png" alt="Cinque Terre" width="400">
                </div>
                <p id="welcome">
                    Welcome to Webchat! The website for everything chatting!
                </p>
                <p>
                    We are two students trying to create a safe environment for others who just wanna talk about a lot of random stuff. In this webchat you can post anything you like! As well as edit and delete it. Just make sure you select the chatroom of the corresponding topic beforehand.
                </p>
            </div>
        </div>
        <div id="footer-container">
            <?php include("$phpPath/footer.php") ?>
        </div>  
    </body>
</html>