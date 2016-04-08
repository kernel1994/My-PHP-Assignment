<?PHP
header("Content-Type: text/html; charset=utf8");

$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$picPath = $_POST["picPath"];
$selfSummary = $_POST["selfSummary"];
$skill = $_POST["skill"];
session_start();
$user = $_SESSION["user"]["id"];

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

include('connect.php');
$con->query("SET NAMES UTF8");
$sql = "insert into tb_resume(id, user) values ('$id', '$user')";
$sql2 = "update tb_resume set name = '$name', age = $age, gender = '$gender', email = '$email', phone = '$phone', skill = '$skill', pic_path = '$picPath', self_summary = '$selfSummary' where id = '$id'";
$con->query("SET NAMES UTF8");

if ($con->query($sql) == true) {
    if ($con->query($sql2) == true) {
        $retData["errNum"] = 0;
        $retData["retMsg"] = "简历提交成功";
//        $retData["retData"] = ["reLink" => "login.html"];
    } else {
        $retData["errNum"] = 1;
        $retData["retMsg"] = "简历提交失败";// $con->error;
    }
} else {
    if ($con->query($sql2) == true) {
        $retData["errNum"] = 0;
        $retData["retMsg"] = "简历修改成功";
//        $retData["retData"] = ["reLink" => "login.html"];
    } else {
        $retData["errNum"] = 1;
        $retData["retMsg"] = "简历修改失败";// $con->error;
    }
}

$con->close();
exit(json_encode($retData));
