<?php 
session_start();
include_once "php/includes/autoload.inc.php";
$new  = new Articles();
$cat  = new Admin();

//for category
$categories = $cat->displayCategories();

// for widgit
$widget = $new->widget();

$page = $new->pagination();
$page1 = ceil($page/2);

if (isset($_GET["page"])) {
    $pageC =$_GET["page"];
} else{
    $pageC="";
}
if (empty($_GET["page"])) {
    $pager = 0;
}  else{
    $pager  = ($_GET["page"]* 2) -2;  
}

$articles = $new->displayArticles($pager);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" /> 
        <link href="css/main.css" rel="stylesheet" /> 
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2021</div>
                            <h2 class="card-title">Featured Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                    <!-- Nested row for non-featured blog posts-->
                     

                    <div class="row">
                    <?php foreach ($articles as  $value) {
                            $photo = $value["article_image"];
                            $checkPhoto = substr($photo, strrpos($photo, "/")+1);
                    ?>
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" style="object-fit: all; height: 350px; max-width: 700px;"
                                         src="<?php if (!empty($checkPhoto)) {
                                             echo "admin/".$value["article_image"];
                                         } else{
                                            echo "admin/".$value["article_image2"];
                                            } ?>" alt="kdsf" />
                                     </a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?php echo $value['article_date']; ?></div>
                                        <h2 class="card-title h4"><?php echo $value['article_title']; ?></h2>
                                        <p class="card-text"><?php echo substr_replace($value['article_text'], "", 90); ?></p>
                                        <a class="btn btn-primary" href="blog.php?id=<?php echo  $value["article_id"]; ?>&topic=<?php echo  $value["article_title"]; ?>">Read more →</a>
                                    </div>
                                </div>
                        </div>
                   <?php } ?>
                        
                       
                    </div>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4 pager">
                           <?php for ($i=1; $i <=$page1 ; $i++) {
                            if (!isset($_GET["page"])) {
                                $pageC = 1;
                            }

                                if ($i == $pageC && $pageC) {?>
                                    <li>
                                        <a class="active" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } else {?>
                                    <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php } }?>
                        </ul>
                    </nav>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                         <div class="row">
                            <?php 
                                foreach ($categories as $value) {?>
                                    <div class="col-sm-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><a href="#!"><?php echo  $value["category_name"]; ?></a></li>
                                            
                                        </ul>
                                    </div>
                               <?php  }
                            ?>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                     <div class="card mb-4">
                        <div class="card-header">You Might Also Like</div>
                        <?php
                            foreach ($widget as  $value) {?>
                            <div class="card">
                                <div class="card-body row">
                                    <img class="img-card col-4" src="admin/<?php echo $value["article_image"]; ?>" style="object-fit: all; height: 100px;" alt="image"></img>
                                    <div class="col-8">
                                        <div class="small text-muted"><?php echo $value["article_date"]; ?></div>
                                        <h2 class="card-title" style="font-size: 15px;"><?php echo $value["article_title"]; ?></h2>
                                        <p class="card-text"><?php echo substr_replace($value['article_text'], "", 90); ?></p>
                                        <a class="btn btn-primary" href="blog.php?id=<?php echo  $value["article_id"]; ?>&topic=<?php echo  $value["article_title"]; ?>" style="font-size: 13px;">Read more →</a>
                                    </div>
                                </div>
                            </div>     
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
