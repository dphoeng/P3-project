<?php

require_once "../pages/mysql.php";

var_dump($_FILES["file"]["tmp_name"]);
var_dump(basename($_FILES["file"]["name"]));
$save_dir = "./src/img/uploads/";
$save_file = $save_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
echo $imageFileType;

?>