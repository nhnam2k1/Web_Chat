<?php
    $mainPath = "../";
    $phpPath = "../php/";
	$jsPath="../j/";
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
        <link rel="stylesheet" type="text/css" href="../css/chat.css">
        <title>Webchat</title>
    </head>
    <body>
        <div id="header-container">
            <?php include("$phpPath/header.php") ?>
        </div>
        <div id="chat-container">
            <div class="rooms-container">
                <select id="rooms" name="Chatrooms">
                                        
                </select>
            </div>
            <div id="chat-box">
                <div id="chat-data">
                            
                </div>
            </div>
        </div>
        <form action="" method="POST" id="chat-form" onsubmit="">
            <input type="text" id="chat-text" name="message" />
            <input type="hidden" name="action" id="action" value="insert" />
            <button type="button" class="add">Send</button>
        </form>
        <div id="footer-container">
            <?php include("$phpPath/footer.php") ?>
        </div>
    </body>
</html>
<script src="../js/jquery.min.js"></script>  
<script src="../js/jquery-ui.js"></script>
<script src="../js/script.js"></script>