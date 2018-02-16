<?php
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];
$email = $input['email'];

print_r(json_encode("This message was returned by the register api. Received username = " . $username . ", password = " . $password . ", email = " . $email . "."));
