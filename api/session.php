<?php
session_start();
header('Content-Type: application/json');
print_r(json_encode($_SESSION));
