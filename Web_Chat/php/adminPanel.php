<?php
    //include_once('Config/Session.php');
    include_once('Model/ProfileModel.php');
    include_once('Model/LoginModel.php');
    include_once('Model/RoomModel.php');
    include_once('Controller/InputValidation.php');
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $action = $_POST['action'];
            $result['data'] = "";

            $inputValidation = new InputValidation();
            $action = $inputValidation->CleanData($action);

            switch($action) {
                case 'load-users':
                {
                    $result['data'] = LoadUserData();
                    http_response_code(200);
                    break;
                }
                case 'load-rooms':
                {
                    $result['data'] = LoadRoomData();
                    http_response_code(200);
                    break;
                }
                case 'promote-user':
                {
                    PromoteUser();
                    $result['data'] = "Successful promote user";
                    http_response_code(200);
                    break;
                }
                case 'block-user':
                {
                    BlockUser();
                    $result['data'] = "Successful block user";
                    http_response_code(200);
                    break;
                }
                case 'create-new-room':
                {
                    CreateNewRoom();
                    $result['data'] = "Success create new chatting room";
                    http_response_code(200);
                    break;
                }  
                default:
                {
                    http_response_code(403);
                    $error['error'] = "Does not support this action";
                    echo json_encode($error);
                    return;
                }
            }

            $result['error'] = "";

            echo json_encode($result);
            return;
        }
        catch(Exception $e)
        {
            http_response_code(403);
            $error['error'] = $e->GetMessage();
            echo json_encode($error);
            return;
        }
    }

    function LoadUserData(){
        $profileModel = new ProfileModel();
        $userData = $profileModel->GetNamesFromDatabase();
        return $userData;
    }

    function LoadRoomData(){
        $roomModel = new RoomModel();
        $roomsData = $roomModel->GetAllRooms();
        return $roomsData;
    }

    function PromoteUser(){
        $userID = $_POST['userID'];
        $loginModel = new LoginModel();
        $inputValidation = new InputValidation();
        $userID = $inputValidation->CleanData($userID);
        $loginModel->PromoteUserToAdmin($userID);
    }   

    function BlockUser(){
        $userID = $_POST['userID'];
        $loginModel = new LoginModel();
        $inputValidation = new InputValidation();
        $userID = $inputValidation->CleanData($userID);
        $loginModel->BlockUserFromLogin($userID);
    }

    function CreateNewRoom(){
        $roomModel = new RoomModel();
        $newRoom = $_POST['newRoom'];
        $inputValidation = new InputValidation();
        $newRoom = $inputValidation->CleanData($newRoom);
        $roomModel->CreateNewRoom($newRoom);
    }
?>