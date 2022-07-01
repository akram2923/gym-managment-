$(document).ready(function() {
    GetStatusCustomer('Active');
    GetStatusCustomer('Inactive');
    GetIncome();

    function GetStatusCustomer(status) {

        $.ajax({
            method: "POST",
            url: "../api/customer.php",
            data: {"action" : "GetStatusCustomer","status": status},
            dataType: "JSON",
            async: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#Active").html(message['Active']);
                    $("#Inactive").html(message['Inactive']);

                }

            },
            error: function(data) {

            }
        });

    }
    function GetIncome() {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "GetIncome"},
            dataType: "JSON",
            async: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#income").html("$"+message['Income']);

                }

            },
            error: function(data) {

            }
        });

    }

});