<?php

header("Content-Type: application/json");

include("connection.php");

$action = $_POST['action'];

function insert($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL expense_sp('', '$description', '$amount', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Inserted")
            $result_data = array("status" => true, "message" => "New Expense has been saved successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function update($conn) {
    extract($_POST);
    $user_id = $_SESSION['user_id'];
    $query = "CALL expense_sp('$expense_id', '$description', '$amount', '$user_id', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Updated")
            $result_data = array("status" => true, "message" => "Expense has been updated successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function load($conn) {
    $query = "SELECT `id` ID, `description` as Description, `amount` as Amount, `created_date` as Date FROM `expenses`";
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
    $query = "SELECT * FROM `expenses` WHERE id = '$expense_id'";
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
    $query = "DELETE FROM expenses WHERE id = '$expense_id'";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $result_data = array("status" => true, "message" => "Expense has been deleted successfully");
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