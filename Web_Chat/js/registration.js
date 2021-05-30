$(document).ready(function(){
    let validateInput = new ValidateInput();

    $("#registration-form").submit(function(){
        let values = $(this).serializeArray();

        let firstName = values[0].value;
        let lastName = values[1].value;
        let gender = values[2].value;
        let birthdate = values[3].value;
        let email = values[4].value;
        let username = values[5].value;
        let password = values[6].value;
        let repassword = values[7].value;

        if (gender == "male"){
            gender = "M";
        }
        else{
            gender = "F";
        }

        try
        {
            validateInput.ValidateUsername(username);
            validateInput.ValidatePassword(password);
            validateInput.ValidateName(firstName);
            validateInput.ValidateName(lastName);
            validateInput.ValidateConfirmPasswrod(password, repassword);

            $.ajax({
                type: 'POST',
                url:  'php/RegistrationForm.php',
                data: {
                    'Username' : username,
                    'Password' : password,
                    'ConfirmPassword' : repassword,
                    'FirstName' : firstName,
                    'LastName'  : lastName,
                    'Gender' : gender,
                    'Birthdate' : birthdate,
                    'Email' : email
                },
                success: function(response){
                    let myObj = JSON.parse(response);

                    if (myObj.error != "")
                    {
                        alert(myObj.error);
                        return false;
                    }
                    alert('register Successful');
                    window.location.replace("login.php"); 
                    return true;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                        "error thrown: " + errorThrown);
                    return false;
                }
            });
        }
        catch(err)
        {
            alert(err);
            return false;
        }
    });
});