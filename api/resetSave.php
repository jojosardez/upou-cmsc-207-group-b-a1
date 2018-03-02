<?php
// Load configuration
$config = parse_ini_file('config.ini');

// Extract posted data and prepare data
$input = json_decode(file_get_contents('php://input'), true);
$username = base64_decode(trim($input['encodedUsername']));
$password = trim($input['password']);
$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
$response = [
    'success' => false,
    'errorcode' => 0,
    'message' => '',
];

try {
    $pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    // Update user record
    $query = "UPDATE users SET password = :encryptedPassword, datemodified = :datemodified WHERE LCASE(username) = LCASE(:username)";
    $statement = $pdo->prepare($query);
    $datemodified = date('Y-m-d H:i:s');
    $statement->bindParam(':datemodified', $datemodified);
    $statement->bindParam(':encryptedPassword', $encryptedPassword);
    $statement->bindParam(':username', $username);
    $result = $statement->execute();

    // Commit transaction
    $pdo->commit();

    // Set successful response
    $response['success'] = true;
    $response['message'] = 'Please login with your new password.';
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
    $response['message'] = $e->getMessage() . ' Please inform the administrator.';
}

// Return response
header('Content-Type: application/json');
print_r(json_encode($response));
