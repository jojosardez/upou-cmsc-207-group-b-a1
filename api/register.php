<?php
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];
$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
$email = $input['email'];
$loginattempts = 0;
$admin = 0;
$active = 0;
$datecreated = date('Y-m-d H:i:s');
$datemodified = date('Y-m-d H:i:s');

$config = parse_ini_file('config.ini');
/*
$connection = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
if ($connection->connect_error) {
print_r(json_encode("An error was encountered while connecting to the database: ".$connection->connect_error));
}
$query = "INSERT INTO users (username, password, email, loginattempts, admin, active, datecreated, datemodified)
VALUES ('$username', '$encryptedPassword', '$email', $loginattempts, $admin, $active, '$datecreated', '$datemodified')";
if ($connection->query($query) === TRUE) {
print_r(json_encode("User account successfuly created!"));
} else {
print_r(json_encode("An error was encountered while saving the user record: " . $connection->error));
}
$connection->close();
 */

//TO DO: more stuff...
try {
    $pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = "INSERT INTO users (username, password, email, loginattempts, admin, active, datecreated, datemodified)
            VALUES (:username, :password, :email, :loginattempts, :admin, :active, :datecreated, :datemodified)";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $encryptedPassword);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':loginattempts', $loginattempts);
    $statement->bindParam(':admin', $admin);
    $statement->bindParam(':active', $active);
    $statement->bindParam(':datecreated', $datecreated);
    $statement->bindParam(':datemodified', $datemodified);
    $result = $statement->execute();
    print_r(json_encode("User account successfuly created!"));
} catch (Exception $e) {
    print_r(json_encode("An error was encountered while saving the user record: " . $e->getMessage()));
}
