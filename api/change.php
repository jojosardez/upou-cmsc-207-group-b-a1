<?php
// Start session
session_start();

// Load configuration
$config = parse_ini_file('config.ini');

// Extract posted data and prepare data
$input = json_decode(file_get_contents('php://input'), true);
$username = $_SESSION["user"];
$currentPassword = $input['currentPassword'];
$newPassword = password_hash($input['newPassword'], PASSWORD_DEFAULT);
$response = [
    'success' => false,
    'errorcode' => 0,
    'message' => '',
];

try {
    $pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    // Check user record
    $query = "SELECT * FROM users WHERE LCASE(username) = LCASE(:username) LIMIT 1";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':username', $username);
    $result = $statement->execute();

    if ($statement->rowCount() === 0) {
        // Record not found
        $response['errorcode'] = 1;
        $response['message'] = 'There were no user account found with the given details.';
    } else {
        // Get username and email
        $record = $statement->fetchAll();
        $password = $record[0]['password'];

        // Check if passwords are same
        if (password_verify($currentPassword, $password)) {
            // Update user record
            $query = "UPDATE users SET password = :password, datemodified = :datemodified WHERE LCASE(username) = LCASE(:username)";
            $statement = $pdo->prepare($query);
            $datemodified = date('Y-m-d H:i:s');
            $statement->bindParam(':datemodified', $datemodified);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $newPassword);
            $result = $statement->execute();

            // Commit transaction
            $pdo->commit();

            // Set successful response
            $response['success'] = true;
            $response['message'] = 'Please login with your new password.';
        } else {
            $response['message'] = 'The current password you have provided didn\'t match with the one you have in record.';
        }
    }
} catch (PDOException $pe) {
    // Set failure response
    $errorCode = $pe->getCode();
    $response['errorcode'] = $errorCode;
    if ((string) $errorCode === '2002') {
        $response['message'] = 'The database couldn\'t be reached. Please inform the administrator.';
    } else if ((string) $errorCode === '1045') {
        $response['message'] = 'The database credentials are incorrect. Please inform the administrator.';
    } else {
        $response['message'] = $pe->getMessage() . ' Please inform the administrator.';
    }
} catch (Exception $e) {
    // Set failure response
    $response['errorcode'] = 1000;
    $response['message'] = $e->getMessage();
}

// Return response
header('Content-Type: application/json');
print_r(json_encode($response));
