<?PHP
header("Content-Type: text/html; charset=utf8");

include('connect.php'); // 链接数据库

$email = $_POST['email']; // post 获得用户名表单值
$password = $_POST['password']; // post 获得用户密码单值

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

if ($email && $password) {
    $sql = "select u.id, u.name, r.name as role from tb_user as u inner join tb_role as r on u.role = r.id where email = ? and password = ?";
    $con->query("SET NAMES UTF8");
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $retData["errNum"] = 0;
        $retData["retMsg"] = "登录成功";
        
        $row = $result->fetch_assoc();
        
        if ($row['role'] == '简历提交者') {
            $retData["retData"] = ["reLink" => "wirte.html"];
        } elseif($row['role'] == '简历查询者') {
            $retData["retData"] = ["reLink" => "view.html"];
        }
        
        session_start();
        $_SESSION['user'] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'role' => $row['role']
        ];
    } else {
        $retData["errNum"] = 1;
        $retData["retMsg"] = "用户名或密码错误";
    }

    $result->close();
    $stmt->close();

} else {
    $retData["errNum"] = 2;
    $retData["retMsg"] = "表单填写不完整";
}

$con->close();
exit(json_encode($retData));
