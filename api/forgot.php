<?php
$input = json_decode(file_get_contents('php://input'), true);
$usernameOrEmail = $input['usernameOrEmail'];

print_r(json_encode("This message was returned by the forgot api. Received usernameOrEmail = " . $usernameOrEmail . "."));
