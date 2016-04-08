<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/8
 * Time: 11:22
 */
header("Content-Type: text/html; charset=utf8");

if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $sql = "select * from tb_resume where id = '$id' or user = '$id'";
} else {
    $sql = "select * from tb_resume";
}

session_start();
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["role"] == "简历提交者") {
        $editable = true;
    } elseif($_SESSION["user"]["role"] == '简历查询者') {
        $editable = false;
    }
}

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null,
    "editable" => "init"
];

include('connect.php');
$con->query("SET NAMES UTF8");
$result = $con->query($sql);

if ($result->num_rows == 0) {
    $retData["errNum"] = 1;
    $retData["retMsg"] = "查看简历失败";
} elseif ($result->num_rows > 0) {
    $retData["errNum"] = 0;
    $retData["retMsg"] = "查看简历成功";
    $retData["editable"] = $editable;
    $retData["retData"] = [];

    $i = 0;
    while($row = $result->fetch_assoc()) {
        $retData["retData"][$i++] = [
            "id" => $row["id"],
            "name" => $row["name"],
            "gender" => $row["gender"],
            "age" => $row["age"],
            "email" => $row["email"],
            "phone" => $row["phone"],
            "skills" => $row["skill"],
            "picPath" => $row["pic_path"],
            "selfSummary" => $row["self_summary"],
            "otherOpinion" => $row["other_opinion"]
        ];
    }
}

$result->close();
$con->close();
exit(json_encode($retData));
