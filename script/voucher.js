$(document).ready(function() {

    if (window.location.href.indexOf('?') != -1){
        var parameters = window.location.href.slice(window.location.href.indexOf('?') + 1).split('=');
        var payment_id = parameters[1];
        FetchPayment(payment_id);
    }

    $("#print").on("click", function(e) {
        e.preventDefault();
        print();
    });

    function print() {
        var win = window.open("");
        var print_voucher = $("#print_voucher").html();
        var head = $("head").html();
        win.document.write("<html><head></head><body>");
        win.document.write(print_voucher);
        win.document.write("</body></html>");
        win.print();
        win.close();
        window.location = "customer_payment.php";
    }

    function FetchPayment(payment_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "get_employee_payroll_voucher", "payment_id" : payment_id},
            dataType: "JSON",
            async: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#date").html(message['date']);
                    $("#voucher").html(message['voucher']);
                    $("#customers").html(message['names']);
                    $("#description").html(message['description']);
                    $("#amount").html(message['amount']);

                }

                copy_voucher();
                print();

            },
            error: function(data) {

            }
        });

    }

    function copy_voucher() {
        var original = $("#original_voucher").html();
        $("#copy_voucher").html(original);
    }

});