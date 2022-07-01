$(document).ready(function() {

    var btn_action = "Insert";
    LoadPayroll();

    $("#tbl_payroll").on("click", "button.edit", function() {
        var payroll_id = $(this).attr("payroll_id");
        btn_action = "Update";
        FillEmployee();
        FetchPayroll(payroll_id);
    });
    
    $("#tbl_payroll").on("click", "button.delete", function() {
        var payroll_id = $(this).attr("payroll_id");
        if (confirm("Are you sure to delete Payroll:" + payroll_id)) {
            DeletePayroll(payroll_id);
        }
    });

    $("#new_modal").on("click", function() {
        ShowModal();
        $("#form_payroll")[0].reset();
        FillEmployee();
    });

    $("#form_payroll").on("submit", function(e) {
        e.preventDefault();
        var payroll_id = $("#payroll_id").val();
        var employee_id = $("#employee_id").val();
        var description = $("#description").val();
        var amount = $("#amount").val();
        var date = $("#date").val();

        var data = {
            "action" : "update",
            "payroll_id" : payroll_id,
            "employee_id" : employee_id,
            "description" : description,
            "amount" : amount,
            "date" : date
        };

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: data,
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {
                    $("#mdl_alert").removeClass('alert-danger');
                    $("#mdl_alert").addClass('alert-success');
                    $("#mdl_alert").css('display', 'block');
                    $("#mdl_alert .alert-message").html(message);
                    btn_action = "Insert";
                    window.scroll(0, 0);
                    $("#form_payroll")[0].reset();
                    LoadPayroll();
                }
                else {
                    $("#mdl_alert").addClass('alert-danger');
                    $("#mdl_alert").removeClass('alert-success');
                    $("#mdl_alert").css('display', 'block');
                    $("#mdl_alert .alert-message").html(message);
                    window.scroll(0, 0);
                }
            },
            error: function(data) {

            }
        });

    });

    function LoadPayroll() {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "load"},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;
                var column = '';
                var row = '';

                if (status == true) {

                    message.forEach(function(item, i) {

                        column = "<tr>";

                        for (index in item) {
                            column += "<th>" + index + "</th>";
                        }
                        column += "<th>Action</th>";

                        column += "</tr>";


                        row += "<tr>";

                        for (index in item) {
                            row += "<td>" + item[index] + "</td>";
                        }

                        row += `<td>
                                <button class='btn btn-info btn-sm edit' payroll_id='` + item['ID'] + `'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete' payroll_id='` + item['ID'] + `'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                                </td>`;

                        row += "</tr>";

                    });

                    $("#tbl_payroll thead").html(column);
                    $("#tbl_payroll tbody").html(row);
                    $("#tbl_payroll").DataTable();

                }
                else {
                    $("#tbl_payroll tbody").html("<tr><td colspan='100%' class='text-center'>" + message + "</td></tr>");
                }

            },
            error: function(data) {

            }
        });

    }

    function FetchPayroll(payroll_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "fetch", "payroll_id" : payroll_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#payroll_id").val(message['id']);
                    $("#employee_id").val(message['employee_id']);
                    $("#description").val(message['description']);
                    $("#amount").val(message['amount']);
                    $("#date").val(message['created_date']);

                    ShowModal();

                }

            },
            error: function(data) {

            }
        });

    }

    function DeletePayroll(payroll_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer_payment.php",
            data: {"action" : "delete", "payroll_id" : payroll_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {
                    $("#main_alert").removeClass('alert-danger');
                    $("#main_alert").addClass('alert-success');
                    $("#main_alert").css('display', 'block');
                    $("#main_alert .alert-message").html(message);
                    window.scroll(0, 0);
                    LoadPayroll();
                }
                else {
                    $("#main_alert").addClass('alert-danger');
                    $("#main_alert").removeClass('alert-success');
                    $("#main_alert").css('display', 'block');
                    $("#main_alert .alert-message").html(message);
                    window.scroll(0, 0);
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

                    message.forEach(function(item, i) {

                        options += `<option value="` + item['employee_id'] + `"> ` + item['name'] + `</option>`;

                    });

                    $("#employee_id").html(options);

                }

            },
            error: function(data) {

            }
        });

    }

    function ShowModal() {        
        $("#main_alert").css('display', 'none');
        $("#mdl_alert").css('display', 'none');
        $("#mdl_payroll").modal('show');
    }


});
