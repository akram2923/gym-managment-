<?php

header("Content-Type: application/json");

include("connection.php");

$action = $_POST['action'];

function insert($conn) {
    extract($_POST);
    $user_id = generate($conn);
    $query = "CALL user_sp('$user_id', '$name', '$username', '$password', '$status', '$Privileges','$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Inserted")
            $result_data = array("status" => true, "message" => "New User has been saved successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function update($conn) {
    extract($_POST);
    $query = "CALL user_sp('$user_id', '$name', '$username', '$password', '$status','$Privileges', '$date')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if ($message['Message'] == "Updated")
            $result_data = array("status" => true, "message" => "User has been updated successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function load($conn) {
    $query = "SELECT `user_id` as 'ID', `name` as Name, `username` as Username, `status` as Status,`Privileges`, `created_date` as Date FROM `users`";
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
    $query = "SELECT * FROM `users` WHERE user_id = '$user_id'";
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
    $query = "DELETE FROM users WHERE user_id = '$id'";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $result_data = array("status" => true, "message" => "User has been deleted successfully");
    }
    else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

function fill($conn) {
    $query = "SELECT user_id, `name` FROM `users`";
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

function generate($conn) {
    $query = "SELECT user_id FROM users ORDER BY user_id ASC";
    $result = $conn->query($query);
    
    $user_id = '';

    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_id = $row['user_id'];
            }
            $user_id++;
        }
        else {
            $user_id = $_SESSION['user_id'];
        }
    }

    return $user_id;    
}

function login($conn) {
    extract($_POST);
    $query = "CALL login_sp('$username', '$password')";
    $result = $conn->query($query);
    $result_data = array();

    if ($result) {
        $message = $result->fetch_assoc();
        if (isset($message['Message'])) {
            if ($message['Message'] == "Locked") {
                $result_data = array("status" => false, "message" => "User has been locked");
            }
            else {
                $result_data = array("status" => false, "message" => "Username or Password is incorrect");
            }
        }
        else {
            foreach($message as $key => $value) {
                $_SESSION[$key] = $value;
            }
            $result_data = array("status" => true, "message" => "User is allowed");
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