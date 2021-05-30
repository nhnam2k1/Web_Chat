<?php
    $configPath = "Config";
    $controllerPath = "Controller";
    $classPath = "Class";
    $modelPath = "Model";

	include_once("$configPath/Session.php");
	include_once("$configPath/SessionEnd.php");
	include_once("$controllerPath/ChatController.php");
    include_once("$classPath/Chat.php");
    include_once("$modelPath/RoomModel.php");

    $controller = new ChatController();

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $id = $controller->GetFirst();
        echo json_encode($id);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_GET["Action"] == "GetFirst")
        {
            $id = $controller->GetFirst();
            json_encode($id);
        }

        if ($_POST["Action"] == "Insert")
        {
            $id = 0;
            $timezone = date_default_timezone_set("Europe/Amsterdam");
            $date = date("Y-m-d H:m:s");
            $message = $_POST["Message"];
            $userID = $_SESSION['ID'];
            $roomID = $_POST["RoomID"];

            $controller->Add(new Chat($id, $date, $message, $userID, $roomID));
        }

        if ($_POST["Action"] == "Edit")
        {
            $id = $_POST["ID"];
            $timezone = date_default_timezone_set("Europe/Amsterdam");
            $date = date("Y-m-d H:m:s");
            $message = $_POST["Message"];
            $userID = 0;
            $roomID = 0;

            $controller->Edit(new Chat($id, $date, $message, $userID, $roomID));
        }

        if ($_POST["Action"] == "Delete")
        {
            $id = $_POST['ID'];

            $controller->Delete($id);
        }
    }
?>