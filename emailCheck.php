<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/6
 * Time: 20:47
 */
include('connect.php');
$email = $_GET["email"];

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

include ("isValidEmail.php");
isValidEmail($con, $email, $retData);

$con->close();
exit(json_encode($retData));
