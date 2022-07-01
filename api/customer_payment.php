<?php

header("Content-Type: application/json");

include("connection.php");

$action = $_POST['action'];

function insert($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL payroll_sp('', '$employee_id', '$description', '$amount', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Insert")
            $result_data = array("status" => true, "message" => $message['Id']);
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}



function update($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL payroll_sp('$payroll_id', '$employee_id', '$description', '$amount', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Updated")
            $result_data = array("status" => true, "message" => "Employee Payroll has been updated successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}


function load($conn) {
    $query = "SELECT `id` as ID, employees.name as `Customer Name`, `description` as Description, `amount` as Amount, payrolls.created_date as Date FROM payrolls LEFT JOIN employees ON payrolls.employee_id = employees.employee_id";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result_data = array("status" => true, "message" => $data);
        }
        else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}


function fetch($conn) {
    extract($_POST);
    $query = "SELECT * FROM payrolls WHERE id = '$payroll_id'";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            $row = $result->fetch_assoc();
            $data = $row;
            $result_data = array("status" => true, "message" => $data);
        }
        else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}


function delete($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "DELETE FROM payrolls WHERE id = '$payroll_id'";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $result_data = array("status" => true, "message" => "Employee Payroll has been deleted successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function get_recent_payrolls($conn) {
    extract($_POST);
    $query = "SELECT * FROM payrolls WHERE employee_id = '$employee_id' ORDER BY created_date DESC LIMIT 3";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            $result_data = array("status" => true, "message" => $data);
        }
        else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);

}

function get_employee_payroll_voucher($conn) {
    extract($_POST);
    $query = "SELECT payrolls.id as voucher, employees.name as names, payrolls.description, payrolls.amount, payrolls.created_date as date FROM payrolls LEFT JOIN employees ON payrolls.employee_id = employees.employee_id WHERE id = '$payment_id'";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $result_data = array("status" => true, "message" => $row);
        }
        else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}
    
function GetIncome($conn) {
    extract($_POST);
    $query = "SELECT ROUND(SUM(amount), 2) As Income FROM `payrolls` WHERE EXTRACT(YEAR FROM payrolls.created_date)= (SELECT EXTRACT(YEAR FROM CURRENT_DATE))";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $result_data = array("status" => true, "message" => $row);
        }
        else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}


if (isset($action)) {
    $action($conn);
}


?>