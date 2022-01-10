<?php 
session_start();

if (!isset($_SESSION["admin"])) {
    header("location:../index.php");
}

//include_once "php/includes/autoload.inc.php";

// if (isset($_POST["register"])) {
//     $username = htmlspecialchars(trim($_POST["username"]));
//     $email = $_POST["email"];
//     $fname = htmlspecialchars($_POST["fname"]);
//     $lname = htmlspecialchars($_POST["lname"]);
//     $password = htmlspecialchars($_POST["password"]);
//     $cpassword = htmlspecialchars($_POST["cpassword"]);

    // $obj = new Admin();
    // $obj->save($username, $email, $password, $cpassword, $fname, $lname);
    // $msg = $obj->message();
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
        <title>User Registration</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                     <div class="text-center mb-3">
                                          <?php 
                                            /*if (isset($msg)) {
                                                    if ($msg !== "Sign up successful") {?>                                   
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
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" name="fname" type="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" name="lname" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="email" name="email" type="email" placeholder="e.g abc@example.com" />
                                                        <label for="email">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="username" type="text" name="username" placeholder="choose a username" />
                                                        <label for="username">Username</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="cpassword" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block" name="register" id="register">Create Account</button></div>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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
