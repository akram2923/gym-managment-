$(document).ready(function () {

    $("#form_login").on("submit", function(e) {
        e.preventDefault();

        var username = $("#username").val();
        var password = $("#password").val();

        var data = {
            "action" : "login",
            "username" : username,
            "password" : password
        };

        $.ajax({
            method : "POST",
            url : "../api/user.php",
            data : data,
            dataType : "JSON",
            async : true,
            success : function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {
                    window.location = "home.php";
                }
                else {
                    $("#main_alert").addClass('alert-danger');
                    $("#main_alert").removeClass('alert-success');
                    $("#main_alert").css('display', 'block');
                    $("#main_alert .alert-message").html(message);
                }
            },
            error : function(data) {

            }
        });

    });

});