$(document).ready(function () {

    FillCustomer();

    $("#print").on("click", function() {
        $("#search").hide();
        var report_area = $("#report_area").html();
        var win = window.open("");
        win.document.write("<html><body>");
        win.document.write(report_area);
        win.document.write("</body></html>");
        win.print();
        win.close();
    });

    $("#search").on("keyup", function() {

        var search = $("#search").val().toLowerCase();

        $("#tbl_statement tbody tr").filter(function() {

            $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1);

        });

    });

    $('#export').on('click', function() {
        $("#search").hide();
        let file = new Blob([$('#report_area').html()], {type:"application/vnd.ms-excel"});
        let url = URL.createObjectURL(file);
        let a = $("<a />", {
          href: url,
          download: "Customer Report Statement.xls"}).appendTo("body").get(0).click();
    });

    $("#form_statement").on("submit", function(e) {
        e.preventDefault();

        var customer_id = $("#customer_id").val();
        var date_type = $("#date_type").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        
        if (date_type == "All") {
            start_date = '';
            end_date = '';
        }

        if (customer_id == "All") {
            $("#main_alert").addClass('alert-danger');
            $("#main_alert").css('display', 'block');
            $("#main_alert .alert-message").html("Please Select the Customer Name !!");
            return false;
        }
        $("#main_alert").removeClass('alert-danger');
        $("#main_alert").css('display', 'none');
        
        var data = {
            "action" : "get_customer_statement",
            "customer_id" : customer_id,
            "start_date" : start_date,
            "end_date" : end_date
        };

        $.ajax({
            method : "POST",
            url : "../api/customer.php",
            data : data,
            dataType : "JSON",
            async : true,
            success : function(data) {
                var status = data.status;
                var message = data.message;
                var row = '';

                if (status == true) {
                    
                    message.forEach(function(item, i) {

                        row += "<tr>";

                        if (item["Date"] == "") {
                            row += "<td colspan='3'>" + item["Description"] + "</td>";
                            row += "<td>" + item["Amount"] + "</td>";
                        }

                        for (index in item) {
                            if (item["Date"] != "")
                            row += "<td>" + item[index] + "</td>";
                            
                        }
                        row += "</tr>";

                    });

                    
                    $("#tbl_statement tbody").html(row);

                }
            },
            error : function(data) {

            }
        });

    });

    function FillCustomer() {
        $("#customer_id").html('');
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
                    options += `<option value="All"> Select Customer: </option>`;
                    message.forEach(function(item, i) {

                        options += `<option value="` + item['employee_id'] + `"> ` + item['Number'] + ` | `+item['name']  +`</option>`;

                    });

                    $("#customer_id").html(options);
                    $("#customer_id").select2();

                }

            },
            error: function(data) {

            }
        });

    }

});