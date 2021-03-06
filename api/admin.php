<?php
session_start();
$config = parse_ini_file('config.ini');


try {
	$pdo = new PDO('mysql:host=' . $config['db_server'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
	$statement=$pdo->prepare("SELECT * FROM users");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);

	print_r(json_encode(array($_SESSION,$results)));	
} catch (Exception $e) {
    header('Content-Type: application/json');
    print_r(json_encode("An error was encountered while saving the user record: " . $e->getMessage()));
}


