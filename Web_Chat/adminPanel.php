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
        <link rel="stylesheet" type="text/css" href="css/adminPanel.css">
        <title>Admin page</title>
    </head>
    <body>
        <?php include("$phpPath/header.php"); ?>
        <div class="row">
            <div id="users-area" class="column">
                <table id="tbl-users-permission">
                    <tr>
                        <th>Name</th>
                        <th>Permissions</th>
                    </tr>
                </table>
            </div>
            <div id="rooms-area" class="column">
                <div class="row">
                    <div class="column">
                        <form action="" id="create-new-room-form">
                            <h1>New Room</h1>
                            <div class="textbox">
                                <label>
                                    New room:
                                    <input type="text" name="room" id="room" placeholder="Gaming">
                                </label>
                            </div>
                            <div>
                                <button type="submit">
                                    Create New Room
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="column">
                        <table id="tbl-rooms">
                            <tr>
                                <th>Rooms</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include("$phpPath/footer.php"); ?>
        <script src="js/jquery-3.5.1.js"></script>
        <script src="js/validateInput.js"></script>
        <script src="js/adminPanel.js"></script>
    </body>
</html>