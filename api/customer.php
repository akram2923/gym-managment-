<?php

header("Content-Type: application/json");

include("connection.php");

$action = $_POST['action'];

function insert($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL employee_sp('', '$name','$Number', '$status', '$fee', '$type', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Inserted")
            $result_data = array("status" => true, "message" => "New Customer has been saved successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function update($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL employee_sp('$employee_id', '$name', '$Number','$status', '$fee', '$type', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Updated")
            $result_data = array("status" => true, "message" => "Customer has been updated successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function load($conn) {
    $query = "SELECT `employee_id` as ID, `name` as `Name`,`Number`, `fee` as fee, `type` as `Type`, `created_date` as Date,`status` as `status` FROM `employees`";
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
    $query = "SELECT * FROM `employees` WHERE employee_id = '$employee_id'";
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
    $query = "DELETE FROM employees WHERE employee_id = '$employee_id'";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $result_data = array("status" => true, "message" => "Customer has been deleted successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function fill($conn) {
    $query = "SELECT employee_id, `name`,`Number` FROM `employees`";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while($row = $result->fetch_assoc()) {
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

function get_employee_info($conn) {
    extract($_POST);
    $query = "CALL get_employee_info_sp('$employee_id')";
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

function GetStatusCustomer($conn) {
    extract($_POST);
    if ($status=='Active') {
        $query = "SELECT COUNT(employee_id) As Active FROM `employees` WHERE employees.status='$status'";
    } else {
        $query = "SELECT COUNT(employee_id) As Inactive FROM `employees` WHERE employees.status='$status'";
    }
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

function get_customer_statement($conn) {
    extract($_POST);
    $query = "CALL get_customer_statement_sp('$customer_id', '$start_date', '$end_date')";
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



if (isset($action)) {
    $action($conn);
}


?>