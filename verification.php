<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
            crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>
    <?php
if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];
    include('db.php');
    $sql = "SELECT * FROM users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1";
    $query = mysqli_query($conn , $sql);
    $result = mysqli_num_rows($query);
    if($result == 1){
        $update = "UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1";
        $querydb = mysqli_query($conn , $update);
        if($querydb){
            echo "Your account have been verified";
        }
        
    }


    else{
        echo "This account invalid or already verified";
    }
}
else{
    die("Some thing went wrong");
}
?>
        
    </body>
</html>