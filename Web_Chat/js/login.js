$(document).ready(function(){
    let loginForm = $("#login-form");
    let validateInput = new ValidateInput();

    $("#login-form").submit(function(){
        let values = $(this).serializeArray();
        let username = values[0].value;
        let password = values[1].value;

        try{
            validateInput.ValidateUsername(username);
            validateInput.ValidatePassword(password);

            $.ajax({
                type: 'POST',
                url: 'php/loginForm.php',
                data:{
                    'Username' : username,
                    'Password' : password
                },
                success: function(response) {
                    let myObj = JSON.parse(response);

                    if (myObj.error != "")
                    {
                        alert(myObj.error);
                        return false;
                    }

                    if (myObj.IsBlocked == true || myObj.IsBlocked == '1')
                    {
                        alert("You are blocked from this chat service !");
                        return false;
                    }

                    alert("You are successful login");
                    if (myObj.IsAdmin == '1')
                    {
                        window.location.replace("adminPanel.php");
                    }
                    else
                    {
                        window.location.replace("profile.php");
                    } 
                    return true;
                }, 
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                        "error thrown: " + errorThrown);
                }
            });
            return false;
        }
        catch(error)
        {
            alert(error);
            return false;
        }
    });
});