<?php 

session_start();
if (!isset($_SESSION["admin"])) {
    header("location:../index.php");
}
include_once "../php/classes/database.class.php";
include_once "../php/classes/articles.class.php";



    

    
$article = new Articles();



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/all.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <!--                     navbar                           -->

        <?php include_once "assets/header.php"; ?>
        <!--                     side bar                            -->
         <?php include_once "assets/sidebar.php"; ?>

        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                        
                        <div class="container">
                            <div>
                            <span class="msg"></span>
                        </div>

                           <!-- <form method="POST"> -->
                               <input type="text" name="cat" id="cat" placeholder="Add Category Here..." style="width: 96.5%; height: 50px;"><br><br>
                              
                          <br>
                               <button type="submit" class="btn btn-primary btn-block" id="addCat" name="addCat">Add Category</button>
                            <!-- </form> -->

                        </div>

                    </div>
                </main>
                       <!-- footer and scripts -->
      <?php  include_once "assets/footer.php";?>
</html>
