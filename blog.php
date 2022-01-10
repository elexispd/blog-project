<?php 

include_once "php/includes/autoload.inc.php";

session_start();

if (isset($_SESSION["user"])) {
    $session = $_SESSION["user"];
}

if (isset($_GET["id"])) {
    $obj = new Articles();
    $list = $obj->displayCategories();
    $imag = $obj->filterImage($_GET["id"]);

    $single = $obj->singleArticle($_GET["id"], $_GET["topic"]);
    $widget = $obj->widget();

   





} else{
    header("location:index.php");
}
$cat  = new Admin();

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
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
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
 
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">

                	<?php 
                		foreach ($single as $value) {?>
                		<h2 class="fw-bolder mt-5"><?php echo $value["article_title"]; ?></h2>
                		<div class="mb-4">
                			<div class="row">
                				<!-- <span class="text-danger" style="font-size: 20px;"></span> -->
                				<div class="col-6"><span class="text-danger" style="font-size: 20px;">A</span><span class="text-muted">uthor: 	</span><?php echo ucfirst($value["article_author"]); ?></div>
	                			<div class="col-6"><span class="text-danger" style="font-size: 20px;">D</span><span class="text-muted">ate Of Publication: </span> <?php echo ($value["article_date"]); ?></div>
                                <span id="article_id" hidden><?php echo $value["article_id"] ?></span>
                			</div>
                			
                		</div>
	                		
		                	<div>
		                		<img src="admin/<?php echo $imag; ?>" style="object-fit: all; height: 350px; width: 100%;" alt="image">
		                	</div>
                			<p class="mt-3"> 
                				<?php echo $value["article_text"]; ?>
                			</p>
                    <?php               $article_category = $value["category"];}
                    ?>
               
                <div class="mt-4 mb-5">
                    <h2 class="text-primary">Related Articles</h2>
                    
                        
                        <?php  
                            $related = $obj->relatedArticles($article_category);
                            foreach ($related as  $valueR) {?>
                            <div class="card">
                                <div class="card-body row">
                                    <img class="img-card col-4" src="admin/<?php echo $valueR["article_image"]; ?>" style="object-fit: all; height: 200px;" alt="image"></img>
                                    <div class="col-8">
                                        <div class="small text-muted"><?php echo $valueR["article_date"]; ?></div>
                                        <h2 class="card-title"><?php echo $valueR["article_title"]; ?></h2>
                                        <p class="card-text"><?php echo substr_replace($valueR['article_text'], "", 90); ?></p>
                                        <a class="btn btn-primary" href="blog.php?id=<?php echo  $valueR["article_id"]; ?>&topic=<?php echo  $valueR["article_title"]; ?>">Read more →</a>
                                    </div>
                                </div>
                            </div>     
                        <?php } ?>      
                </div>


                    <h6>comments <span class="badge badge-dark mb-2" id="show_total"></span></h6>


                    <div class="comment mb-5" id="comment_section">
                       
                    </div>

                	<form action="#" id="comment_form">
                        <div>
                            <span class="msg"></span>
                        </div>
                        <textarea class="form-control" id="text" name="content" placeholder="write your article here..."></textarea> <br>
                         <input type="text" id="email" readonly = "readonly" tabindex="-1" name="email" placeholder="Email not available" style="width: 300px; border-radius: 40px" value="<?php if(isset($session)){
                                echo $session; 
                            } else{ echo ''; } ?>" > 
                        <input type="text" id="email" hidden=""  name="email" value="<?php if(isset($session)){
                                echo $session; 
                            } else{ echo ''; } ?>" > 

                        <a href="login.php" id="signup">Login</a><br><br>
                         <input type="" hidden name="id" id="id" value="<?php echo $_GET['id']; ?>">
                         <!-- <input type="" hidden name="url" id="url" value="<?php echo $valueR["article_title"]; ?>"> -->
                        <button type="submit" class="btn btn-primary mb-5" name="com">Add Post</button>
                        
                    </form>

                    
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
                                foreach ($list as $value) {?>
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
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/main.js"></script>

        <script>   
        	var value = "<?php echo $session; ?>";
            $("#email").attr('disabled', true);
        	if (value == "") {
        		$("#signup").show();
        	} else {
        		$("#signup").hide();
        	}
        </script>

         <script>
            function disappear(){
                $(".msg").html("")
                
            }
             $("form").on('submit', function(e){
                $.post('php/includes/article.inc.php', $(this).serialize(), function(data){
                    if (data == "You Commented") {
                         $(".msg").html(data).css('color','green');
                         $("textarea").val("");
                     } 
                     else{
                        $(".msg").html(data).css('color','red');
                        $("textarea").val("");

                     }
                })
                setInterval(disappear, 5000);
                e.preventDefault();
            })
        </script>

        <script>
            
            // display();
            // setInterval(display, 2000);

            

            // function display(){
            //         var get = $("#article_id").text();
            //         $.ajax({
            //             url: "php/includes/comment.inc.php",
            //             type: "POST",
            //             dataType: "JSON",
            //             data: 'get='+get,
            //             success: function(data){
            //                 $("#comment_section").empty();
            //                 for (var i = 0; i < data.length; i++) {
            //                     var str =data[i].user_email;
            //                     $("#comment_section").append('<div class="mt-3"><span style="padding: 10px; border-radius: 50px;" class="bg-info text-white" id="who">'+str.charAt(0)+' </span><i class="text-info">says: </i><span class="lead text-secondary" id="says"> '+data[i].comment_text+'</span>');
            //                 }

            //             }
            //         })
            // }

        </script>

        <script>
            var get = $("#article_id").text();
        
            function display(){
                // var get = $("#article_id").text();
                $.ajax({
                    url: "php/includes/comment.inc.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {cmd: 'comments', id: get},
                    success: function(data){
                       $("#comment_section").empty();
                            for (var i = 0; i < data.length; i++) {
                                var str =data[i].user_email;
                                $("#comment_section").append('<div class="mt-3"><span style="padding: 10px; border-radius: 50px;" class="bg-info text-white" id="who">'+str.charAt(0)+ ' </span> <i class="text-info ml-2"> says: </i><span class="lead text-secondary" id="says"> '+data[i].comment_text+'</span>');
                            }
                    }
                })
            }

            function total(){
            $.ajax({
                url: "php/includes/comment.inc.php",
                type: "POST",
                dataType: "JSON",
                data: {cmd: 'total', id: get},
                success: function(data){
                    $("#show_total").html(data);
                }
                  
                })
            }
            display();
            setInterval(display, 2000);
            total();
            setInterval(total, 2000);
        </script>
    </body>
</html>
