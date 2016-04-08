<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/8
 * Time: 14:54
 */
header("Content-Type: text/html; charset=utf8");

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

$opinion = $_POST["opinion"];
$id = $_POST["id"];

include('connect.php');
$con->query("SET NAMES UTF8");
$sql = "update tb_resume set other_opinion = '$opinion' where id = '$id'";

if ($con->query($sql) === true) {
    $retData["errNum"] = 0;
    $retData["retMsg"] = "意见提交成功";
} else {
    $retData["errNum"] = 1;
    $retData["retMsg"] = "意见提交失败";// $con->error;
}

$con->close();
exit(json_encode($retData));
