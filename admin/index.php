<?php 
include_once "../php/classes/database.class.php";
include_once "../php/classes/admin.class.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("location:login.php");
} else{
    $adminObj = new Admin();
    $list = $adminObj->displayUsers();
    $total_user = $adminObj->totalUsers();
    $total_admin = $adminObj->totalAdmin();
    $total_post = $adminObj->totalPost();
    $total_comment = $adminObj->totalComment();
    if (isset($_GET["delete"])) {
        $adminObj->deleteUser($_GET["delete"]);
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
        
        <!--                     side bar                            -->

        <?php include_once "assets/sidebar.php"; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-user-right"></i><?php echo $total_user; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Posts</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-book-right"></i><?php echo $total_post; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Total Comments</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-comment-right"></i><?php echo $total_comment; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Vistors</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="small text-white"><i class="fas fa-user-right"></i><?php echo $page_count; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Visits Chart
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Users Chart
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>User Id</th>
                                            <th>User Email</th>
                                            <th>User Photo</th>
                                            <th>Delete User</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php foreach ($list as $value) {?>
                                            <tr>
                                                <td><?php echo $value["id"]; ?></td>
                                                <td><?php echo $value["username"]; ?></td>
                                                <td><?php echo $value["user_id"]; ?></td>
                                                <td><?php echo $value["user_email"]; ?></td>
                                                <td><?php echo $value["user_dp"]; ?></td>
                                                <td><a class="delete_link" href="javascript:void(0)" rel="<?php echo $value["user_id"]; ?>"> <i class="fa fa-trash text-danger"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                        
                                           
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </main>
                <span></span>


                <!-- footer and scripts -->
      <?php  include_once "assets/footer.php";?>
    </body>

    <script>
        $(document).ready(function(){
            $(".delete_link").click(function(){
                var id = $(this).attr("rel");
                var delete_url = "index.php?delete="+id +" ";
            
            $(".modal_link").attr("href", delete_url);
            $("#exampleModal").modal("show");
            })
        })
    </script>
</html>
