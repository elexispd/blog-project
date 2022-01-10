<?php
include_once "../php/classes/database.class.php";
include_once "../php/classes/admin.class.php";
session_start();
 if (!isset($_SESSION["admin"])) {
    header("location:../index.php");
} else{
    $adminObj = new Admin();
    $list = $adminObj->displayComment(); 
    if (isset($_GET["delete"])) {
        $adminObj->deleteComment($_GET["delete"]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
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
                        <h1 class="mt-4">Posts Page</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Comments</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                All Comments below
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Article Id</th>
                                            <th>Date</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php foreach ($list as $value) {?>
                                            <tr>
                                                <td><?php echo $value["id"]; ?></td>
                                                <td><?php echo $value["user_email"];?></td>
                                                <td><?php echo $value["comment_text"]; ?></td>
                                                <td><?php echo $value["article_id"]; ?></td>
                                                <td><?php echo $value["comment_date"]; ?></td>
                                                <td><a class="delete_link" href="javascript:void(0)" rel="<?php echo $value["comment_id"]; ?>"> <i class="fa fa-trash text-danger"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                        
                                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                </div>
                  <!-- footer and scripts -->
      <?php  include_once "assets/footer.php";?>
       <script>
        $(document).ready(function(){
            $(".delete_link").click(function(){
                var id = $(this).attr("rel");
                var delete_url = "comments.php?delete="+id +" ";
            
            $(".modal_link").attr("href", delete_url);
            $("#exampleModal").modal("show");
            })

            
        })
    </script>
    </body>
</html>
