<?php
/**
 * Created by PhpStorm.
 * User: kernel
 * Date: 2016/4/7
 * Time: 1:03
 * 邮箱校验函数
 * @param $con "数据库链接对象"
 * @param $email "需要验证的email"
 * @param $retData "写入结果的数组"
 * @return bool 邮箱是否可用
 */

function isValidEmail(&$con, $email, &$retData) {
    $sql = "select * from tb_user where email = '$email'";

    if ($email == null || $email == "") {
        $retData["errNum"] = 2;
        $retData["retMsg"] = "邮箱必填";
        
        return false;
    }
    
    if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
        $retData["errNum"] = 3;
        $retData["retMsg"] = "邮箱格式错误";

        return false;
    }

    $result = $con->query($sql);
    if ($result->num_rows == 0) {
        $retData["errNum"] = 0;
        $retData["retMsg"] = "邮箱可用";
        
        $result->close();
        return true;
    } else {
        $retData["errNum"] = 1;
        $retData["retMsg"] = "邮箱已注册";

        $result->close();
        return false;
    }
}
