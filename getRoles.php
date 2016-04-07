<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/6
 * Time: 23:47
 */
header("Content-Type: text/html; charset=utf8");

include('connect.php');
$sql = "select * from tb_role";
$con->query("SET NAMES UTF8");
$result = $con->query($sql);

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

if ($result->num_rows == 0) {
    $retData["errNum"] = 1;
    $retData["retMsg"] = "角色表为空";
} elseif ($result->num_rows > 0) {
    $retData["errNum"] = 0;
    $retData["retMsg"] = "成功读取角色信息";
    $retData["retData"] = [];

    $i = 0;
    while($row = $result->fetch_assoc()) {
        $retData["retData"][$i++] = [
            "id" => $row["id"],
            "name" => $row["name"]
        ];
    }
}

$result->close();
$con->close();
exit(json_encode($retData));
