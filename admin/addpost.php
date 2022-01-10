<?php 

session_start();
if (!isset($_SESSION["admin"])) {
    header("location:../index.php");
}
include_once "../php/classes/database.class.php";
include_once "../php/classes/articles.class.php";



    

    
$article = new Articles();
$list = $article->displayCategories();
$article->insideImage();



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
                            <li class="breadcrumb-item active">Add Article</li>
                        </ol>
                        
                        <div class="container">

                             <?php 
                            

                                if (isset($_POST["submit"])) {
                                  if (!isset($_POST["cat"])) {
                                    $_POST["cat"] = "";
                                  }
                                    $article->addPost($_POST["title"],$_POST["content"], $_POST["cat"] );
                                  
                                  
                                   
                                }
                                   $article->message(); 
                              ?>
                            <form method="POST" enctype="multipart/form-data">
                               <input type="text" name="title" placeholder="title" style="width: 96.5%; height: 50px;"><br><br>
                               <!-- <textarea rows="20" cols="150" name="content" placeholder="write your article here..."></textarea> <br><br> -->
                                <textarea name="content" placeholder="write your article here..."></textarea> <br><br>
                              <div class="form-row">   
                                <div class="custom-file col-lg-6 col-md-12" >
                                  <label class="custom-file-label text-left" for="customFile">Feature Image</label>
                                  <input type="file" id="upload" name="photo1" value="<?php //if(isset($_POST["photo"])){echo $_POST["photo"];} ?>" class="custom-file-input col-lg-6 col-md-12" placeholder="Ipload">
                                </div>
                                <div class="custom-file col-lg-6 col-md-12">
                                  <label class="custom-file-label text-left" for="customFile">Choose image1</label>
                                  <input type="file" id="upload" name="photo2" value="<?php //if(isset($_POST["photo"])){echo $_POST["photo"];} ?>" class="custom-file-input col-lg-6 col-md-12" placeholder="Ipload">
                                </div>
                                <div>
                                  <select class="custom-select" name="cat">
                                    <option selected disabled>Choose a caterogy</option>
                                    <?php 
                                      foreach ($list as  $value) {?>
                                        <option value="<?php echo $value["category_name"]; ?>" ><?php echo $value["category_name"]; ?></option>
                                      <?php }

                                    ?>
                                  </select>
                                </div>
                              </div>
                          <br>
                         
                               <button type="submit" class="btn btn-primary btn-block" name="submit">Add Post</button>

                            </form>

                        </div>

                    </div>
                </main>
                       <!-- footer and scripts -->
      <?php  include_once "assets/footer.php";?>
</html>
