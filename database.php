<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "theraaid";

$var_conn = new mysqli($hostname, $username, $password, $database);

if ($var_conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $var_conn->connect_error;
    exit();
}