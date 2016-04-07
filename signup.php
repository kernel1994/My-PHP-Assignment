<?php
header("Content-Type: text/html; charset=utf8");

$id = $_POST["id"];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = $_POST['role'];

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

include('connect.php');
$con->query("SET NAMES UTF8");
$sql = "insert into tb_user(id, name, email, password, role) values ('$id', '$username', '$email', '$password', '$role')";

include ("isValidEmail.php");

// 后台再次验证邮箱是否可用(非空/ 未注册/ 格式合法)
if (isValidEmail($con, $email, $retData)) {
    if ($con->query($sql) === true) {
        $retData["errNum"] = 0;
        $retData["retMsg"] = "注册成功";
        $retData["retData"] = ["reLink" => "login.html"];
    } else {
        $retData["errNum"] = 1;
        $retData["retMsg"] = "注册失败";// $con->error;
    }
}

$con->close();
exit(json_encode($retData));
