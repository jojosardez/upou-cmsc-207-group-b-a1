<?php
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

print_r(json_encode("This message was returned by the login api. Received username = " . $username . ", password = " . $password . "."));
