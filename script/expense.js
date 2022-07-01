$(document).ready(function() {

    var btn_action = "Insert";
    LoadExpense();

    $("#tbl_expense").on("click", "button.edit", function() {
        var expense_id = $(this).attr("expense_id");
        btn_action = "Update";
        FetchExpense(expense_id);
    });
    
    $("#tbl_expense").on("click", "button.delete", function() {
        var expense_id = $(this).attr("expense_id");
        if (confirm("Are you sure to delete Expense:" + expense_id)) {
            DeleteExpense(expense_id);
        }
    });

    $("#new_modal").on("click", function() {
        ShowModal();
        $("#form_expense")[0].reset();        
    });

    $("#form_expense").on("submit", function(e) {
        e.preventDefault();
        var expense_id = $("#expense_id").val();
        var description = $("#description").val();
        var amount = $("#amount").val();
        var date = $("#date").val();

        if (btn_action == "Insert") {
            var data = {
                "action" : "insert",
                "description" : description,
                "amount" : amount,
                "date" : date
            };
        }
        else {
            var data = {
                "action" : "update",
                "expense_id" : expense_id,
                "description" : description,
                "amount" : amount,
                "date" : date
            };
        }

        $.ajax({
            method: "POST",
            url: "../api/expense.php",
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
                    $("#form_expense")[0].reset();
                    LoadExpense();
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

    function LoadExpense() {

        $.ajax({
            method: "POST",
            url: "../api/expense.php",
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
                                <button class='btn btn-info btn-sm edit' expense_id='` + item['ID'] + `'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete' expense_id='` + item['ID'] + `'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                                </td>`;

                        row += "</tr>";

                    });

                    $("#tbl_expense thead").html(column);
                    $("#tbl_expense tbody").html(row);
                    $("#tbl_expense").DataTable();

                }
                else {
                    $("#tbl_expense tbody").html("<tr><td colspan='100%' class='text-center'>" + message + "</td></tr>");
                }

            },
            error: function(data) {

            }
        });

    }

    function FetchExpense(expense_id) {

        $.ajax({
            method: "POST",
            url: "../api/expense.php",
            data: {"action" : "fetch", "expense_id" : expense_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#expense_id").val(message['id']);
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

    function DeleteExpense(expense_id) {

        $.ajax({
            method: "POST",
            url: "../api/expense.php",
            data: {"action" : "delete", "expense_id" : expense_id},
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
                    LoadExpense();
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

    function ShowModal() {        
        $("#main_alert").css('display', 'none');
        $("#mdl_alert").css('display', 'none');
        $("#mdl_expense").modal('show');
    }


});
