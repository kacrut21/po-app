<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "", 3306);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$mysqli->query("CREATE DATABASE IF NOT EXISTS `po-app`");
echo "Database checked/created.";
