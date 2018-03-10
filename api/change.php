<?php
$input = json_decode(file_get_contents('php://input'), true);
$username = trim($input['username']);
$currentPassword = trim($input['currentPassword']);
$newPassword = trim($input['newPassword']);
$encryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$datemodified = date('Y-m-d H:i:s');

//print_r(json_encode("This message was returned by the change password api. Received username = " . $username . ", currentPassword = " . $currentPassword . ", newPassword = " . $newPassword . "."));


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

            // set the session for current user | set session "CURRENT_user" as 'id' from table users
            if (password_verify($password, $row['password'])) {
            	// change password db
                $sql = "UPDATE `users` SET password = '" . $encryptedPassword . "' WHERE username='" . $username . "'";
                // result -> is the result of the query of $sql
                $result = $con->query($sql);
                // update date modified
                $sql = "UPDATE `users` SET datemodified = " . $datemodified . " WHERE username='" . $username . "'";
                // result -> is the result of the query of $sql
                $result = $con->query($sql);

                $response['success'] = true;
                $response['message'] = "Password changed";
            } else {
                $row['loginattempts'] = $row['loginattempts'] + 1;
                $sql = "UPDATE `users` SET loginattempts = " . $row['loginattempts'] . " WHERE username='" . $username . "'";
                // result -> is the result of the query of $sql
                $result = $con->query($sql);
                $response['errorcode'] = 1000;
                $response['message'] = "Password invalid.";
            }
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

