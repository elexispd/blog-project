<?php 
// include_once "php/includes/autoload.inc.php";

// if (isset($_POST["login"])) {
//     $email = $_POST["email"];
//     $password = htmlspecialchars($_POST["password"]);

//     $obj = new User();
//     $obj->login($email, $password);
//     $msg = $obj->message();
// } else {
//     # code...
// }



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    <div class="text-center mb-3">
                                          <?php 
                                          /*if (isset($msg)) {
                                                    if ($msg !== "Login successful") {?>                                   
                                                    <span class="text-danger msg"><?php echo $msg; ?></span>
                                                    <?php } else {?>
                                                     <span class="text-success msg"><?php echo $msg; ?></span>
                                                    <?php }
                                                } else{
                                                    echo "";

                                                }*/
                                                ?>
                                                <span class="msg"></span>
                                     </div>
                                        <!-- <form method="POST"> -->
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="userEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="userEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="userPassword" type="password" name="password" placeholder="Password" />
                                                <label for="userPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="userRememberPassword" type="checkbox" value="" name="remember" />
                                                <label class="form-check-label" for="userRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <button class="btn btn-primary" name="login"  id="userLogin">Login</button>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!-- <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/mainAjax.js"></script>
        <script src="js/redirect.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
