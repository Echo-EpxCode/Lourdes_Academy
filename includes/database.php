<?php

require_once 'database_setup.php';

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "laas_db"
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>