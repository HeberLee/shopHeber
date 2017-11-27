<?php
require_once "../lib/string.func.php";
require_once "./upload.func.php";
$fileInfo = array();
$fileInfo['filename'] = $_FILES['myFile']['name'];
$fileInfo['type'] = $_FILES['myFile']['type'];
$fileInfo['tmp_name'] = $_FILES['myFile']['tmp_name'];
$fileInfo['error'] = $_FILES['myFile']['error'];
$fileInfo['size'] = $_FILES['myFile']['size'];

$upload = uploadFile($fileInfo);
echo $upload;

?>