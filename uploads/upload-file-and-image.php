<?php
if(isset($_POST['submit'])){
    $file = $_FILES['file'];

    //lấy ra tên file , nơi lưu trữ tạm thời của file , kích thước,lỗi và kiểu của file gán cho các biến
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.' , $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //các file mà mình muốn người dùng có thể upload lên được
    $allowed = array('jpg' , 'jpeg' , 'png' , 'pdf');

    if(in_array($fileActualExt , $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = uniqid('' , true).".".$fileActualExt;
                $fileDestination = 'uploads'.$fileNameNew;
                move_uploaded_file($fileTmpName , $fileDestination);
                echo 'upload images successfully';
            }
            else{
                echo'Your file is too big';
            }
        }
        else{
            echo 'There was an error uploading your file';
        }
    }
    else{
        echo 'You cannot upload file of this type!';
    }
}
else{

}