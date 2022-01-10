<?php 
include_once "../php/classes/database.class.php";
include_once "../php/classes/admin.class.php";




 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/all.min.css" rel="stylesheet" />
</head>
<body>
<!-- 
<?php //echo strlen("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla."); ?>
<form>
  <textarea name="content" id="content" class="ckeditor"></textarea>
</form>
  	
<img alt="" src="assets/img/1562850996.jpg" style="height:501px; width:500px" />



        <script src="js/jquery.js"></script>
        <script src="js/ckeditor/ckeditor.js"></script>
        <script>
          CKEDITOR.replace("content", {
            height:300,
            filebrowserUploadUrl: "upload.php",
            filebrowserUploadMethod: "form"
          });
        </script> -->

        <span><?php echo $page; ?></span>
       

               <?php  //substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"], "/")+1);
              //   $url =substr($_SERVER["HTTP_HOST"], strrpos($_SERVER["REQUEST_URI"], "/")+1);
              //   $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; 
              //   $ur = substr($url, strrpos($url, "?")+1);
              //   if ($ur == 1) {
              //     echo "empty";
              //   } else{
                   
              //   }

                  

              //   $name = "Elexis";
                ?>

                 

    <script src= "js/jquery.js"></script> 
    <script type="text/javascript">
      var url = '<?php echo $urll; ?>';
      $("span").text(url);

      if ($("a[href]")) {} else {}
    </script>   

    <script>
      $('#dataTable').DataTable();
    </script>
    
 
</body>
</html>
