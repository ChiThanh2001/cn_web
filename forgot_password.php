<!DOCTYPE html>
<html>
    <head>
        <title>Forgot password</title>      
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
        <div class="container padding-bottom-3x mb-2 mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="forgot">
                        <h2>Forgot your password?</h2>
                        <p>Change your password in three easy steps. This will help you to secure your
                            password!</p>
                        <ol class="list-unstyled">
                            <li>
                                <span class="text-primary text-medium">1.
                                </span>Enter your email address below.</li>
                            <li>
                                <span class="text-primary text-medium">2.
                                </span>Our system will send you a temporary link</li>
                            <li>
                                <span class="text-primary text-medium">3.
                                </span>Use the link to reset your password</li>
                        </ol>
                    </div>
                    <form class="card mt-4">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email-for-pass">Enter your email address</label>
                                <input class="form-control" type="text" id="email-for-pass" required="">
                                <small class="form-text text-muted">Enter the email address you used during the
                                    registration on BBBootstrap.com. Then we'll email a link to this address.</small>
                            </div>
                        </div>
                        <form class="card-footer" method="POST">
                            <button class="btn btn-success" type="submit" name="reset-request-password">Get New Password</button>
                        <form>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>