<?php
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "db_resume";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
