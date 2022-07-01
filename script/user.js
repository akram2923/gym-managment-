$(document).ready(function() {

    var btn_action = "Insert";
    LoadUser();

    $("#tbl_user").on("click", "button.edit", function() {
        var user_id = $(this).attr("user_id");
        btn_action = "Update";
        FetchUser(user_id);
    });
    
    $("#tbl_user").on("click", "button.delete", function() {
        var user_id = $(this).attr("user_id");
        if (confirm("Are you sure to delete User:" + user_id)) {
            DeleteUser(user_id);
        }
    });

    $("#new_modal").on("click", function() {
        ShowModal();
        $("#form_user")[0].reset();
    });

    $("#form_user").on("submit", function(e) {
        e.preventDefault();
        var user_id = $("#user_id").val();
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var status = $("#status").val();
        var Privileges = $("#Privileges").val();
        var date = $("#date").val();

        if (btn_action == "Insert") {
            var data = {
                "action" : "insert",
                "name" : name,
                "username" : username,
                "password" : password,
                "status" : status,
                "Privileges" : Privileges,
                "date" : date
            };
        }
        else {
            var data = {
                "action" : "update",
                "user_id" : user_id,
                "name" : name,
                "username" : username,
                "password" : password,
                "status" : status,
                "Privileges" : Privileges,
                "date" : date
            };
        }

        $.ajax({
            method: "POST",
            url: "../api/user.php",
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
                    LoadUser();
                    $("#form_user")[0].reset();
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

    function LoadUser() {

        $.ajax({
            method: "POST",
            url: "../api/user.php",
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
                            if (index=='Status') {
                              
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
                                <button class='btn btn-info btn-sm edit' user_id='` + item['ID'] + `'>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete' user_id='` + item['ID'] + `'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                                </td>`;

                        row += "</tr>";

                    });

                    $("#tbl_user thead").html(column);
                    $("#tbl_user tbody").html(row);
                    $("#tbl_user").DataTable();

                }
                else {
                    $("#tbl_user tbody").html("<tr><td colspan='100%' class='text-center'>" + message + "</td></tr>");
                }

            },
            error: function(data) {

            }
        });

    }

    function FetchUser(user_id) {

        $.ajax({
            method: "POST",
            url: "../api/user.php",
            data: {"action" : "fetch", "user_id" : user_id},
            dataType: "JSON",
            async: true,
            success: function(data) {
                var status = data.status;
                var message = data.message;

                if (status == true) {

                    $("#user_id").val(message['user_id']);
                    $("#name").val(message['name']);
                    $("#username").val(message['username']);
                    $("#password").val(message['password']);
                    $("#status").val(message['status']);
                    $("#Privileges").val(message['Privileges']);
                    $("#date").val(message['created_date']);

                    ShowModal();

                }

            },
            error: function(data) {

            }
        });

    }

    function DeleteUser(user_id) {

        $.ajax({
            method: "POST",
            url: "../api/user.php",
            data: {"action" : "delete", "id" : user_id},
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
                    LoadUser();
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
        $("#mdl_user").modal('show');
    }


});
