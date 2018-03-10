<?php
// Start the session for account
session_start();

//
error_reporting(0);

//  Intitialize value from login form
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

$config = parse_ini_file('config.ini');

$response = [
    'success' => false,
    'errorcode' => 0,
    'message' => '',
];

// var con -> establish a connection to database assignment1db
$con = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
// test if you can connect to database | if not die
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
// Prepare statement to test if input $username is available in the database
$sql = "SELECT * FROM `users` WHERE username = '$username'";

// result -> is the result of the query of $sql
$result = mysqli_query($con, $sql);

// test if the $result is not null | Must return one row from database
if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (!$row['verified']) {
            $response['errorcode'] = 1000;
            $response['message'] = "Your account is not yet verified. Please check your email to verify your account.";
        } else if (!$row['active']) {
            $response['errorcode'] = 1000;
            $response['message'] = "Your account is inactive. Please contact the administrator to activate your account.";
        }
        // Test if the user has less than or 3 attempts
        else if ($row['loginattempts'] < 3) {
            // set the session for current user | set session "CURRENT_user" as 'id' from table users
            if (password_verify($password, $row['password'])) {
                $sql = "UPDATE `users` SET loginattempts = 0 WHERE username='" . $username . "'";
                // result -> is the result of the query of $sql
                $result = $con->query($sql);
                $_SESSION["user"] = $username;
                $_SESSION["admin"] = $row['admin'];
                $response['success'] = true;
                $response['message'] = "You have login successfully";
            } else {
                $row['loginattempts'] = $row['loginattempts'] + 1;
                $sql = "UPDATE `users` SET loginattempts = " . $row['loginattempts'] . " WHERE username='" . $username . "'";
                // result -> is the result of the query of $sql
                $result = $con->query($sql);
                $response['errorcode'] = 1000;
                $response['message'] = "Username or password invalid.";
            }
        } else {
            $_SESSION["email"] = $row['email'];
            $response['errorcode'] = 2000;
            $response['message'] = "Your account was locked out due to too many login attempts. Would you like to unlock it using your registered email address?";
        }
    }
}
// Username doesn't exist in the table users
else {
    // print a JSON "false" | will be read by login.js
    $response['errorcode'] = 1000;
    $response['message'] = "Username or password invalid.";
}

$con->close();

header('Content-Type: application/json');
print_r(json_encode($response));
