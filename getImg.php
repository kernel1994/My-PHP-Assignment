<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/6
 * Time: 23:47
 */
header("Content-Type: text/html; charset=utf8");

$id = $_POST['id'];
$ext = $_POST['ext'];
$fPath = "userImgs/$id.$ext";

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

if (file_exists($fPath)) {
    $retData["errNum"] = 0;
    $retData["retMsg"] = "读取图片成功";
    $retData["retData"] = ["picPath" => $fPath];
} else {
    $retData["errNum"] = 1;
    $retData["retMsg"] = "读取图片失败";
}

exit(json_encode($retData));
