<?php require"function/database.php";  
      include"inde/header.php";
?>

<html>
  <body>
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    

<!-- Keywords Made by Ashes Yamin -->
  <meta name="description" content="Open Source Journal">
  <meta name="keywords" content="bio-science, journal, Bangladesh">
  <meta name="author" content="Md Hassan Shamim">
<!-- SEO Meta Tag end -->

    <title>EKSU-OJS </title>
    <link href="style.css" rel="stylesheet" type="text/css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <style>
       .user{
          font-size: 20px;
          font-family: 'Courier New', Courier, monospace;
        }
        .parag {
          font-size: 20px;
          font-family: 'Courier New', Courier, monospace;
        }
      </style>

    
    
 <script>
      $(document).ready(function() {
        $('.container').addClass('container-loaded');
      });
    </script>
    


  <body style = "background: rgba(239, 239, 244,.4);">  
        
<div class="container mb-4"  style = "background: white;">
        

     
<!--start main body post code-->        
<div class="col-main">
<div class="col-card">
<div id="post"> 
<?php 

$journal_slug = $_GET['journal']; 
$view = $_GET['view']; //article here for query execute
// echo $view;
// echo $journal_slug;


$sqli ="SELECT * from opaar_article_pdf INNER JOIN opaar_journal on article_id = '$view' And opaar_journal.journal_slug = '$journal_slug'";
$stmtt = $con->prepare($sqli);   
$stmtt->execute();   
    
if ($stmtt->rowCount() > 0) {
while ($journa = $stmtt->fetch()) {;?>   

<h4 class="mt-3">
       <a  download = "<?php echo $journa["article_pdf"];?>" href = "pdf/<?php echo $journa["article_pdf"];?>"><button class = "btn btn-primary">Download PDF <i class = "fa fa-file-pdf-o"></i></button></a>
        
       <a  href = "pdf/<?php echo $journa["article_pdf"];?>"><button class = "btn btn-secondary">View Article <i class = "fa fa-file-pdf-o"></i></button></a>
</h4>
<?php }};


$sql ="SELECT * from opaar_article INNER JOIN opaar_journal on opaar_article.id = '$view' And opaar_journal.journal_slug = '$journal_slug'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
    
if ($stmt->rowCount() > 0) {
while ($journal = $stmt->fetch()) {;?> 

<span >Vol: <?php echo $journal["article_volume"];?></span>
<span >No: <?php echo $journal["article_number"];?></span>

<h3> <?php echo''. $journal["article_title"].'';?></h3> 
<h5> Date Submitted: <?php echo''. $journal["sub_date"].'';?></h5> 

<h5> Date Published: <?php echo''. $journal["datetime"].'';?></h5> 

    <p class ="parag"> <?php echo''. $journal["article_description"].'';?></p>

 
<?php }} else {echo'view not found';};?>


<?php
$sqlm1m="SELECT * FROM opaar_article_users INNER JOIN opaar_users ON opaar_article_users.article_id = opaar_article_users.article_id WHERE opaar_article_users.article_id = '$view';";
$stmt = $con->prepare($sqlm1m);   
$stmt->execute();                                
$meet_array = array();
while ($what = $stmt->fetch()) {

$meet_array[$what['article_author']] = $what;  
}  
    
foreach ($meet_array as $article_author => $meet_data) 
{
    
$user ="SELECT * FROM opaar_users where id = $article_author;";
$stmt = $con->prepare($user);   
$stmt->execute();  
while ($what = $stmt->fetch()) {?>
<div class = "user">Author/Contributor: <b><i><?php echo ''.$what['username'].'';  ?></i></b></div>
 <?php   

}};?>
       
    </div></div>
    
  <!-- <div style="clear:both"></div>  -->
    

       
</div>
        
        </div>     
        <?php 
		include "inde/footer.php";
		?>
    </body>
    
     

</html>
