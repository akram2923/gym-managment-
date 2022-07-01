$(document).ready(function() {

    var btn_action = "Insert";
    LoadEmployee();

    $("#tbl_employee").on("click", "button.edit", function() {
        var employee_id = $(this).attr("employee_id");
        btn_action = "Update";
        FetchEmployee(employee_id);
    });
    
    $("#tbl_employee").on("click", "button.delete", function() {
        var employee_id = $(this).attr("employee_id");
        if (confirm("Are you sure to delete Employee:" + employee_id)) {
            DeleteEmployee(employee_id);
        }
    });

    $("#new_modal").on("click", function() {
        ShowModal();
        $("#form_employee")[0].reset();
    });

    $("#form_employee").on("submit", function(e) {
        e.preventDefault();
        var employee_id = $("#employee_id").val();
        var name = $("#name").val();
        var Number = $("#Number").val();
        var status = $("#status").val();
        var fee = $("#fee").val();
        var type = $("#type").val();
        var date = $("#date").val();

        if (btn_action == "Insert") {
            var data = {
                "action" : "insert",
                "name" : name,
                "Number" : Number,
                "status" : status,
                "fee" : fee,
                "type" : type,
                "date" : date
            };
        }
        else {
            var data = {
                "action" : "update",
                "employee_id" : employee_id,
                "name" : name,
                "Number" : Number,
                "status" : status,
                "fee" : fee,
                "type" : type,
                "date" : date
            };
        }

        $.ajax({
            method: "POST",
            url: "../api/customer.php",
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
                    LoadEmployee();
                    $("#form_employee")[0].reset();
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

    function LoadEmployee() {

        $.ajax({
            method: "POST",
            url: "../api/customer.php",
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
                            if (index=='status') {
                              
                                if (item[index]=='Active') {
                                    row += "<td >  <span class='badge bg-warning'>" + item[index] + " </span></td>";
                                }else{
                                    row += "<td>  <span class='badge bg-danger'>" + item[index] + "</span></td>";
                                }
                                
                            }else{
                                row += "<td>" + item[index] + "</td>";
                            }
                          

                        }

                        row += `<td>
                                <button class='btn btn-info btn-sm edit' employee_id='` + item['ID'] + `'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete' employee_id='` + item['ID'] + `'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                                </td>`;

                        row += "</tr>";

                    });

                    $("#tbl_employee thead").html(column);
                    $("#tbl_employee tbody").html(row);
                    $("#tbl_employee").DataTable();

                }
                else {
                    $("#tbl_employee tbody").html("<tr><td colspan='100%' class='text-center'>" + message + "</td></tr>");
                }

            },
            error: function(data) {

            }
        });

    }

    function FetchEmployee(employee_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer.php",
            data: {"action" : "fetch", "employee_id" : employee_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#employee_id").val(message['employee_id']);
                    $("#name").val(message['name']);
                    $("#Number").val(message['Number']);
                    $("#status").val(message['status']);
                    $("#fee").val(message['fee']);
                    $("#type").val(message['type']);
                    $("#date").val(message['created_date']);

                    ShowModal();

                }

            },
            error: function(data) {

            }
        });

    }

    function DeleteEmployee(employee_id) {

        $.ajax({
            method: "POST",
            url: "../api/customer.php",
            data: {"action" : "delete", "employee_id" : employee_id},
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
                    LoadEmployee();
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
        $("#mdl_employee").modal('show');
    }


});
