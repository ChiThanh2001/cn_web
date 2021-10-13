<?php
require('db.php');
$target_dir = "./upload/";
$filename = $_FILES["fileToUpload"]["name"];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

$tennv = $_POST['fullName'];
$chucvu = $_POST['chucVu'];
$email = $_POST['email'];
$mayban = $_POST['mayBan'];
$sodidong = $_POST['sdt'];
$maDV = $_POST['maDV'];



$sql_insert = "INSERT into db_nhanvien(tennv,chucvu	,mayban	,email,sodidong,madv,image)
          values (' $tennv',' $chucvu','$mayban','$email','$sodidong','$maDV','$target_file')";

mysqli_query($conn, $sql_insert);
if (array_key_exists($imageFileType, $allowed)) {
    // Kiểm tra xem file có tồn tại trước khi upload hay không
    if (file_exists($target_file)) {
        echo $filename . " is already exists.<br>";
    } else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        echo "File của bạn đã upload thành công.";
        header('location: ./index.php');
    }
} else {
    echo 'thất bại';
}
