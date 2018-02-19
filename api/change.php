<?php
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$currentPassword = $input['currentPassword'];
$newPassword = $input['newPassword'];

print_r(json_encode("This message was returned by the change password api. Received username = " . $username . ", currentPassword = " . $currentPassword . ", newPassword = " . $newPassword . "."));
