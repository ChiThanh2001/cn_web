<?php
session_start();
include('db.php');
//tạo biến bắt lỗi để trống form
$err = [];
// $error = NULL;
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];

    $takeEmail = "SELECT * FROM users WHERE email like '%$email'";
    $querydb = mysqli_query($conn , $takeEmail);
    $convertData = mysqli_fetch_assoc($querydb);
    $checkemail = mysqli_num_rows($querydb);
    if(empty($name)){
        $err['name'] = "Bạn chưa nhập tên";
    }
    if(empty($email)){
        $err['email'] = "Bạn chưa nhập email";
    }
    if(empty($password)){
        $err['password'] = "Bạn chưa nhập mật khẩu";
    }
    if($password != $repeatpassword){
        $err['repeatpassword'] = 'Nhập lại mật khẩu không khớp';
    }
    if($checkemail == 1){
      $err['emailExist'] = "Email đã tồn tại";
    }
    if(empty($err)){
      //câu lệnh insert vào databse
      $passhash = password_hash($password,PASSWORD_DEFAULT);

      //generate vkey
      $vkey = md5(time() .$name);
      // var_dump($pass);
      $sql = "INSERT INTO users(name ,email, password,vkey) VALUES('$name' , ' $email' , '$passhash','$vkey')";
      //câu lệnh truy vấn vào database
      $query= mysqli_query($conn , $sql);
    

      if($query){
        header('location: login.php');
        
        //send email
        $name = $_POST['name'];
        $email = $_POST['email'];
        //SMTP needs accurate times, and the PHP time zone MUST be set
        //This should be done in your php.ini, but this is how to do it if you don't have access to that
        date_default_timezone_set('Etc/UTC');

        require 'smtpmail/PHPMailerAutoload.php';

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "satthumaulanh2001@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "baazbgbjxxlcotyt";

        //Set who the message is to be sent from
        $mail->setFrom('satthumaulanh2001@gmail.com', 'Send email');

        //Set an alternative reply-to address
        $mail->addReplyTo('satthumaulanh2001@gmail.com', 'second Last');

        //Set who the message is to be sent to
        $mail->addAddress($email , $name);

        //Set the subject line
        $mail->Subject = "My automatic send email";

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML("<a href='http://localhost/form_login_system/verification.php?vkey=$vkey'>Click here to verification Email</a>");

        //Replace the plain text body with one created manually
        // $mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
          }
        }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .danger{
          color : red;
        }

        .modify{
          border-left: 100px;
          text-decoration: none;
          text-align: center;
        }
    </style>
  </head>
  <body>
    <!-- Form đăng kí -->
    
    <section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>               
                <form class="mx-1 mx-md-4"  method="post">
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="email">Full name</label>
                      <input type="text" id="name" name="name" class="form-control" />
                      
                      <span class ="danger"> <?php echo (isset($err['name']))?$err['name']:'' ?> </span>
                    </div>
                  
                  </div>                
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" />
                      <span class="danger"><?php echo(isset($err['email'])?$err['email'] : "") ?></span>
                      <span class="danger"><?php echo(isset($err['emailExist'])?$err['emailExist']:"")?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control" />
                      <span class="danger"><?php echo(isset($err['password'])?$err['password']:'') ?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="repeatpassword">Repeat your password</label>
                      <input type="password" id="repeatpassword" name="repeatpassword" class="form-control" />
                      <span class="danger"><?php echo(isset($err['repeatpassword'])?$err['repeatpassword']:'') ?></span>
                    </div>
                  </div>

                  <!-- <div class="form-check d-flex justify-content-center mb-5">
                    <input
                      class="form-check-input me-2"
                      type="checkbox"
                      value=""
                      id="form2Example3c"
                    />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div> -->

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg" name="btnRegister">Register</button>                   
                  </div>                  

                </form>

                <!-- nút về trang login form -->
                <a href = "login.php" class="modify"> Go to Login website?</a>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
