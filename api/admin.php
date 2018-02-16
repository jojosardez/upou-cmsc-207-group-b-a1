<?php
$users = array();
$users[] = ['username' => 'hello', 'email' => 'hello@world.com'];
$users[] = ['username' => 'world', 'email' => 'wolrd@hello.com'];

print_r(json_encode($users));
