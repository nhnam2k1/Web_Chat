$(document).ready(function(){
    function room(){
        let roomSelect = $('#rooms');
        let action = "load-rooms";

        $.ajax({
            method: "POST",
            url: "../php/adminPanel.php",
            data: {
                'action' : action
            },
            success: function(response){
                console.log(response);
                let myObj = JSON.parse(response);

                if (myObj.error != "") {
                    alert(myObj.error);
                }

                let rooms = myObj.data;
                for(index in rooms)
                {
                    let room = rooms[index];
                    let id = room.ID;
                    let name = room.Name;
                    roomSelect.append("<option value='" + id + "'>" + name + "</option>");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                    "error thrown: " + errorThrown);
            }
        });
    }

    room();

    function get(id){

        $.ajax({
            url: "../php/ChatData.php",
            type: "POST",
            data: {
                "ID" : id
            },
            success: function(data) {
                $("#chat-data").html(data);
            }
        });
    }

    function selectRoom(){
        let id = $('#rooms option:selected').val();
        get(id);
    }

    $('#rooms').change(function(){
        selectRoom();
    });

    $(document).on("click", ".edit", function(){
        if ($('#chat-text').val() == '')
        {
            $('#chat-text').css('border-color', 'red');
        }
        else
        {
            $('#chat-text').css('border-color', 'black');

            let id = $(this).attr("id");
            let text = document.getElementById("chat-text").value
            let action = 'Edit';

            $.ajax({
                url: "../php/ChatForm.php",
                type: "POST",
                data: {
                    'ID' : id,
                    'Message' : text,
                    'Action' : action
                },
                success: function() {
                    selectRoom();
                    $('#chat-text').val('');
                }
            });
        }
    });

    $(document).on("click", ".delete", function() {
        let id = $(this).attr("id");
        let action = 'Delete';

        $.ajax({
            url: "../php/ChatForm.php",
            type: "POST",
            data: {
                'ID' : id,
                'Action' : action
            },
            success: function()
            {
                selectRoom();
            }
        });
    });

    function fetch() {
        try 
        {
            $.ajax({
                url: "../php/ChatForm.php",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    let myObj = JSON.parse(response);
    
                    let rooms = myObj;
                    for(index in rooms)
                    {
                        let id = rooms[index];
                        get(id);
                    }
                }
            });
        }
        catch(err)
        {
            alert(err);
        }
    }
    
    fetch();

    $('#chat-form').click(function() {
        if($('#chat-text').val() == '')
        {
            $('#chat-text').css('border-color', 'red');
        }
        else
        {
            $('#chat-text').css('border-color', 'black');

            let values = $(this).serializeArray();

            let text = values[0].value;
            let roomID = $('#rooms option:selected').val();
            let action = "Insert";

            try
            {
                $.ajax({
                    type: "POST",
                    url: "../php/ChatForm.php",
                    data: {
                        'RoomID' : roomID,
                        'Message' : text,
                        'Action' : action
                    },
                    success:function()
                    {
                        selectRoom();
                        $('#chat-text').val('');
                    }
                });
            }
            catch (err)
            {
                alert(err);
                return false;
            }
        }
    });
});