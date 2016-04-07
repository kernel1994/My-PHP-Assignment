<?PHP
header("Content-Type: text/html; charset=utf8");

$retData = [
    "errNum" => -1,
    "retMsg" => "init",
    "retData" => null
];

if ((( $_FILES["img"]["type"] == "image/gif")
   || ($_FILES["img"]["type"] == "image/jpeg")
   || ($_FILES["img"]["type"] == "image/pjpeg")
   || ($_FILES["img"]["type"] == "image/png"))
   && ($_FILES["img"]["size"] < 2000000)) {
    
   if ($_FILES["img"]["error"] > 0) {
       $retData["errNum"] = 1;
       $retData["retMsg"] = 'error with ' . $_FILES["img"]["error"];
       
       exit(json_encode($retData));
   } else {
       $id = $_POST["upload-img-id"];
       $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
       $fileName = $id . "." . $extension;
       $filePath = "userImgs/$fileName";
       
       move_uploaded_file($_FILES["img"]["tmp_name"], $filePath);
       
       include('connect.php');
       $con->query("SET NAMES UTF8");
       $sql = "update tb_resume set pic_path = '$filePath' where id = '$id'";
       
       if ($con->query($sql) == true) {
           $retData["errNum"] = 0;
           $retData["retMsg"] = "照片上传成功";
           $retData["retData"] = ["fName" => "userImgs/$fileName"];
        } else {
           $retData["errNum"] = 2;
           $retData["retMsg"] = "照片上传失败";// $con->error;
        }
       $con->close();
   }
}

exit(json_encode($retData));
