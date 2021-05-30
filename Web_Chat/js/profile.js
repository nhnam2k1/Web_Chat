$(document).ready(function(){
    let validateInput = new ValidateInput();

    UpdateTheProfile();

    $('#Profile-edit').submit(function(){
        let values = $(this).serializeArray();
        let sendToArray  = new Object();

        sendToArray['newEmail'] = values[0].value;
        sendToArray['newPassword'] = values[1].value;
        sendToArray['confirmPassword'] = values[2].value;

        try
        {
            let updatePassword = false;
            if (sendToArray['newPassword'] != "")
            {
                validateInput.ValidateConfirmPasswrod(sendToArray['newPassword'], sendToArray['confirmPassword']);
                updatePassword = true;
            }

            let needUpdate = false;
            if (sendToArray['newEmail'] != "")
            {
                needUpdate = true;
            }

            if (!updatePassword && !needUpdate)
            {
                return;
            }
            
            $.ajax({
                type: 'POST',
                url:  'php/ProfileForm.php',
                data: {
                    'newEmail' : sendToArray['newEmail'],
                    'newPassword' : sendToArray['newPassword'],
                    'confirmPassword' : sendToArray['confirmPassword']
                },
                success: function(response){
                    let myObj = JSON.parse(response);

                    if (myObj.error != "") {
                        alert(myObj.error);
                        return false;
                    }

                    if (needUpdate == true) {
                        UpdateTheProfile();
                    }

                    alert('Successful update profile');
                    return true;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                        "error thrown: " + errorThrown);
                    return false;
                }
            });
        }
        catch(error)
        {
            alert(err);
            return false;
        }
    });

    function UpdateTheProfile() {
        // For profile page
        $.ajax({
            type: 'GET',
            url: 'php/ProfileForm.php',
            success: function(response){
                let myObj = JSON.parse(response);
                
                if (myObj.error != "")
                {
                    alert(myObj.error);
                    return false;
                }

                let name = myObj.FirstName + " " + myObj.LastName;
                if (myObj.Gender == 'F')
                {
                    myObj.Gender = 'Female';
                }
                else if (myObj.Gender == 'M')
                {
                    myObj.Gender = 'Male';
                }

                $('#Profile-card #Name').text(name);
                $('#Profile-card #Gender').text(myObj.Gender);
                $('#Profile-card #Birthdate').text(myObj.Birthdate);
                $('#Profile-card #Email').text(myObj.Email);

                return true;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error = " + jqXHR.status + ", status = " + textStatus + ", " +
                    "error thrown: " + errorThrown);
                return false;
            }
        });
    }
});