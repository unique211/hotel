$(document).ready(function() {
    /*---------login-----------------*/
    $(document).on("submit", "#loginform", function(e) {
        e.preventDefault();
        var user_id = $('#user_id').val();
        var password = $('#password').val();

        $.ajax({
            data: $('#loginform').serialize(),
            url: login,
            type: "POST",
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data == 1 || data == "1") {
                    successTost("Login Successfully");
                    location.href = redirect;
                    //  location.href = baseurl + "Welcome/dashboard";
                } else if (data == 2 || data == "2") {
                    swal("Account Expired", "Hey, Your Account is Expired Please Contact Admin !!", "error");
                } else if (data == 3 || data == "3") {
                    swal("Account Deactivated", "Hey, Your Account is Not Activate Please Contact Admin !!", "error");
                } else {
                    errorTost("Invalide Login Detail");
                }

            },
            error: function(data) {
                console.log('Error:', data);

            }
        });
    });
    /*---------login-----------------*/
});