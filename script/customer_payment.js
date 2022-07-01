$(document).ready(function () {

    FillEmployee();

    $("#employee_id").on("change", function() {
        var employee_id = $("#employee_id").val();

        if(employee_id != "0") {
            GetEmployeeInfo(employee_id);
            GetRecentPayrolls(employee_id);
        }
        else {
            $("#balance").html('');
            $("#type").html('');
            $("#title").html('');
            $("#tbl_payroll tbody").html('');
        }
        
    });

    $("#amount").on("keyup", function () {
        $(this).val($(this).val().replace(/[^0-9\.]+/g, ""));
    });

    $("#form_payroll").on("submit", function(e) {
        e.preventDefault();

        var employee_id = $("#employee_id").val();
        var description = $("#description").val();
        var amount = $("#amount").val();
        var date = $("#date").val();

        if (employee_id == "0") {
            alert("Select Employee");
            return;
        }

        var data = {
            "action" : "insert",
            "employee_id" : employee_id,
            "description" : description,
            "amount" : amount,
            "date" : date
        };

        $.ajax({
            method : "POST",
            url : "../api/customer_payment.php",
            data : data,
            dataType : "JSON",
            async : true,
            success : function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {
                    window.location = "voucher.php?payment_id=" + message;
                }
                else {
                    if (Array.isArray(message)) {
                        var str = "<ul>";
                        str += "<li>Please check these errors</li>";
                        message.forEach(function(item, i) {
                            str += "<li>" + item['message'] + "</li>";
                        });
                        str += "</ul>";
                    }
                    $("#main_alert").addClass('alert-danger');
                    $("#main_alert").removeClass('alert-success');
                    $("#main_alert").css('display', 'block');
                    $("#main_alert .alert-message").html(str);
                    window.scroll(0, 0);
                }
            },
            error : function(data) {

            }
        });

    });

    function GetRecentPayrolls(employee_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "get_recent_payrolls", "employee_id" : employee_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var row = '';

                if (status == true) {

                    message.forEach(function(item, i) {

                        row += `<tr><th>` + item['description'] + `</th><td class="text-right">$` + item['amount'] + `</td></tr>`
                        

                    });

                    $("#tbl_payroll tbody").html(row);

                }
                else {
                    $("#tbl_payroll tbody").html(`<tr><th colspan="100%" class="text-center"> No Recent Payments </th></tr>`);
                }

            },
            error: function(data) {

            }
        });

    }

    function FillEmployee() {
        $("#employee_id").html('');
        $.ajax({
            method: "POST",
            url: "../api/customer.php",
            data: {"action" : "fill"},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var options = '';

                if (status == true) {
                    options += `<option value="0">Select Customer</option>`;

                    message.forEach(function(item, i) {

                        options += `<option value="` + item['employee_id'] + `"> ` + item['Number'] +` | `+ item['name'] + ` </option>`;

                    });

                    $("#employee_id").html(options);
                    $("#employee_id").select2();

                }

            },
            error: function(data) {

            }
        });

    }

    function GetEmployeeInfo(employee_id) {
        $.ajax({
            method: "POST",
            url: "../api/customer.php",
            data: {"action" : "get_employee_info", "employee_id" : employee_id},
            dataType: "JSON",
            async: false,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var options = '';

                if (status == true) {
                    $("#type").html(message['type']);
                    $("#title").html(message['status']);
                    $("#number").html(message['Number']);
                    if (message['status'] == "Inactive") {
                        $("#title").css('color', 'red');
                    }else{
                        $("#title").css('color', 'green');
                    }
                    $("#salary").html('$' + message['fee']);
                    $("#salary").css('color', 'green');
            
                    
                }

            },
            error: function(data) {

            }
        });

    }
});