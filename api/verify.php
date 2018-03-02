<?php

// Load configuration
$config = parse_ini_file('config.ini');

// Extract posted data and prepare data
$input = json_decode(file_get_contents('php://input'), true);
$username = base64_decode(trim($input['encodedUsername']));
$token = trim($input['token']);
$response = [
    'success' => false,
    'errorCode' => 0,
    'message' => '',
];

$pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    // Check user record
    $query = "SELECT * FROM users WHERE LCASE(username) = LCASE(:username) AND token = :token LIMIT 1";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':token', $token);
    $result = $statement->execute();

    if ($statement->rowCount() === 0) {
        // Record not found
        $response['errorcode'] = 1000;
        $response['message'] = 'Invalid data. There were no user account found with the given details.';
    } else {
        // Update user record
        $query = "UPDATE users SET token = null, verified = 1, active = 1, datemodified = :datemodified WHERE LCASE(username) = LCASE(:username)";
        $statement = $pdo->prepare($query);
        $datemodified = date('Y-m-d H:i:s');
        $statement->bindParam(':datemodified', $datemodified);
        $statement->bindParam(':username', $username);
        $result = $statement->execute();

        // Commit transaction
        $pdo->commit();

        // Set successful response
        $response['success'] = true;
        $response['message'] = 'Congratulations! You may now login using your account.';
    }
} catch (PDOException $pe) {
    // Rollback transaction
    $pdo->rollBack();

    // Set failure response
    $response['errorcode'] = $pe->getCode();
    $response['message'] = $pe->getMessage();
} catch (Exception $e) {
    // Rollback transaction
    $pdo->rollBack();

    // Set failure response
    $response['errorcode'] = 1000;
    $response['message'] = $e->getMessage();
}

// Return response
header('Content-Type: application/json');
print_r(json_encode($response));
