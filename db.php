<?php
$localhost = 'localhost';
$name = 'root';
$pass = '';
$db = 'user';
$conn = mysqli_connect($localhost , $name , $pass , $db);

if(!$conn){
    echo "xem lại đường dẫn";
}
