/* 
    - start by insert all users to the page
    - insert all rooms from table
    - Checking if which button is triggered
    - Checking if the "new room form" added
    https://www.howtobuildsoftware.com/index.php/how-do/bAdO/jquery-how-to-add-event-listener-to-the-element-with-updated-class
*/
$(document).ready(function(){
    LoadUsersTable();
    LoadRoomsTable();
    DetectPromoteUserBtn();
    DetectBlockUserBtn();
    DetectCreateNewForm();
});

function LoadUsersTable(){
    let userTable = $('#tbl-users-permission');

    $.ajax({
        method: "POST",
        url: "php/adminPanel.php",
        data: {
            'action' : 'load-users'
        },
        success: function(response){
            console.log(response);
            let myObj = JSON.parse(response);

            if (myObj.error != "") {
                alert(myObj.error);
                return false;
            }

            let listOfUsers = myObj.data;

            for (index in listOfUsers){
                let user = listOfUsers[index];
                let username = user.fullname;
                let userID = user.ID;

                let userPermissionRow = CreateNewUserRowData(username, userID);
                userTable.append(userPermissionRow);
            }

            return true;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                "error thrown: " + errorThrown);
        }
    });
}

function CreateNewUserRowData(userName, userID){
    let userRow = document.createElement("tr");
    let userNameCol = document.createElement("td");
    let userPermissionsCol = document.createElement("td");

    let username = document.createTextNode(userName);

    let btnPromoteAdmin = document.createElement("button");
    btnPromoteAdmin.append('Promote to Admin');
    btnPromoteAdmin.className = "button btn-promote-admin";
    btnPromoteAdmin.value = userID;

    let btnBlockUser = document.createElement("button");
    btnBlockUser.append('Block user');
    btnBlockUser.className = "button btn-block-user";
    btnBlockUser.value = userID;

    userNameCol.append(username);
    userPermissionsCol.append(btnPromoteAdmin);
    userPermissionsCol.append(btnBlockUser);

    userRow.append(userNameCol);
    userRow.append(userPermissionsCol);

    return userRow;
}

function LoadRoomsTable(){
    let roomTable = $('#tbl-rooms');

    $.ajax({
        method: "POST",
        url: "php/adminPanel.php",
        data: {
            'action' : 'load-rooms'
        },
        success: function(response){
            console.log(response);
            let myObj = JSON.parse(response);

            if (myObj.error != "") {
                alert(myObj.error);
                return false;
            }

            let listOfRooms = myObj.data;
            for(index in listOfRooms)
            {
                let room = listOfRooms[index];
                let roomName = room.Name;
                let roomRowData = CreateNewRoomRowData(roomName);
                roomTable.append(roomRowData);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                "error thrown: " + errorThrown);
        }
    });
}

function CreateNewRoomRowData(roomName){
    let roomRow = document.createElement("tr");
    let roomNameData = document.createElement("td");
    roomNameData.append(roomName);
    roomRow.append(roomNameData);
    return roomRow;
}

function DetectPromoteUserBtn(){
    $('#tbl-users-permission').on("click", ".btn-promote-admin", function(){
        let userID = $(this).val();

        $.ajax({
            method: "POST",
            url: "php/adminPanel.php",
            data: {
                'action' : 'promote-user',
                'userID' : userID
            },
            success: function(response){
                console.log(response);

                let myObj = JSON.parse(response);
                
                if (myObj.error != ""){
                    alert(myObj.error);
                    return false;
                }

                alert("Promote user " + userID + " Successfully");
                return true;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                    "error thrown: " + errorThrown);
            }
        });
    });
}

function DetectBlockUserBtn(){
    $('#tbl-users-permission').on("click", ".btn-block-user", function(){
        let userID = $(this).val();

        $.ajax({
            method: "POST",
            url: "php/adminPanel.php",
            data: {
                'action' : 'block-user',
                'userID' : userID
            },
            success: function(response){
                console.log(response);

                let myObj = JSON.parse(response);
                
                if (myObj.error != ""){
                    alert(myObj.error);
                    return false;
                }

                alert("Block user " + userID + " Successfully");
                return true;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                    "error thrown: " + errorThrown);
            }
        });
    });
}

function DetectCreateNewForm(){
    try {
        let validateInput = new ValidateInput();
        $("#create-new-room-form").submit(function(){  
              
            let data = $(this).serializeArray();
            validateInput.ValidateName(data[0].value);

            $.ajax({
                method : "POST",
                url : "php/adminPanel.php",
                data : {
                    'newRoom' : data[0].value,
                    'action' : "create-new-room"
                },
                success : function(response){
                    console.log(response);
                    let myObj = JSON.parse(response);

                    if (myObj.error != "") {
                        alert(myObj.error);
                        return false;
                    }

                    alert(myObj.data);
                    return true;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                        "error thrown: " + errorThrown);
                }
            });
        });
    }
    catch(error)
    {
        alert(error);
        return false;
    }
}