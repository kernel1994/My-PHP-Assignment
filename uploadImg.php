<?PHP

function getFilePath() {
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
           $id = $_POST["id"];
           $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
           $fileName = $id . "." . $extension;
           $filePath = "userImgs/$fileName";

           move_uploaded_file($_FILES["img"]["tmp_name"], $filePath);
           
           return $filePath;
       }
    }
}
