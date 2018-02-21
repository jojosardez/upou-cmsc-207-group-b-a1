<?php
$files = glob(__DIR__ . '/lib/PHPMailer-6.0.3/src/*.php');
foreach ($files as $file) {
    require_once $file;
}
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];
$encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
$email = $input['email'];
$loginattempts = 0;
$admin = 0;
$active = 0;
$verified = 0;
$datecreated = date('Y-m-d H:i:s');
$datemodified = date('Y-m-d H:i:s');

$config = parse_ini_file('config.ini');

//TO DO: more stuff...
try {
    $pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO users (username, password, email, loginattempts, admin, active, verified, datecreated, datemodified)
            VALUES (:username, :password, :email, :loginattempts, :admin, :active, :verified, :datecreated, :datemodified)";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $encryptedPassword);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':loginattempts', $loginattempts);
    $statement->bindParam(':admin', $admin);
    $statement->bindParam(':active', $active);
    $statement->bindParam(':verified', $verified);
    $statement->bindParam(':datecreated', $datecreated);
    $statement->bindParam(':datemodified', $datemodified);
    $result = $statement->execute();

    $mail = new PHPMailer;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ));
    $mail->isSMTP();
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Host = $config['smtp_server'];
    $mail->Port = $config['smtp_port'];
    $mail->Username = $config['smtp_username'];
    $mail->Password = $config['smtp_password'];
    $mail->From = $config['smtp_username'];
    $mail->FromName = "CMSC-207 Group B Web Login Module Admin";
    $mail->addAddress($email, $username);
    $mail->isHTML(true);
    $mail->Subject = 'CMSC-207 Group B Web Login Module - Verify your account!';
    $mail->Body = 'Hi ' . $username . ',<br/><br/><strong>Welcome to CMSC-207 Group B\'s Web Login Module!</strong><br/><br/>In order to login to the module, you need to verify your account first. Please click the following link or copy it and navigate to it using your browser: <i>To Do: link stuff</i><br/><br/>Have a nice day!<br/><br/><br/><small>This message was sent by CMSC-207 Group B\'s Web Login Module.</small>';
    $mail->AltBody = "This is the plain text version of the email content";
    $mail->send();

    header('Content-Type: application/json');
    print_r(json_encode("User account successfuly created!"));
} catch (Exception $e) {
    header('Content-Type: application/json');
    print_r(json_encode("An error was encountered while saving the user record: " . $e->getMessage()));
}
