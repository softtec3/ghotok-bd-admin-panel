<?php
$host = "localhost";
$user = "softtec3_ghotok_bd_admin";
$password = "vd)Y&$6nbw+edn%c";
$db_name = "softtec3_ghotok_bd";

$conn = new mysqli($host, $user, $password, $db_name);

if ($conn->connect_errno) {
    echo "failed to connect: " . $conn->connect_error;
    exit();
}
