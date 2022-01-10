<?php
include_once "../php/classes/database.class.php";
include_once "../php/classes/admin.class.php";
session_start();
 if (!isset($_SESSION["admin"])) {
    header("location:../index.php");
} else{
    $adminObj = new Admin();
    $list = $adminObj->displayAdmins();
    $superAdmin = $adminObj->superAdmin($_SESSION["admin"]);

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
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Admin List</li>
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
                               Avaialble admins
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>User Id</th>
                                            <th>Email</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Profile Photo</th>
                                            <th>Role</th>
                                            <th class="hide">Delete</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php foreach ($list as $value) {?>
                                            <tr>
                                                <td><?php echo $value["id"]; ?></td>
                                                <td><?php echo $value["admin_username"]; ?></td>
                                                <td><?php echo $value["user_id"]; ?></td>
                                                <td><?php echo $value["admin_email"]; ?></td>
                                                <td><?php echo $value["first_name"]; ?></td>
                                                <td><?php echo $value["last_name"]; ?></td>
                                                <td><?php echo $value["admin_dp"]; ?></td>
                                                <td><?php echo $value["super_admin"]; ?></td>
                                                <td class="hide"><a class="delete_link" href="javascript:void(0)" rel="<?php echo $value["article_id"]; ?>"><i class="fa fa-trash text-danger"></i></a> </td>
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
                var delete_url = "index.php?delete="+id +" ";
            
            $(".modal_link").attr("href", delete_url);
            $("#exampleModal").modal("show");
            })

            var super_admin = '<?php echo $superAdmin; ?>'
            if (super_admin == '') {
                $(".hide").hide();
            }

            
            
        })
    </script>
    </body>
</html>
