<?php 
require"function/database.php"; 
include"inde/header.php";
?>

<html>
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    
   <!--<script>alert('We are working on our site. Please visit us next month 1 July 2020')</script>-->
    
<!-- Keywords Made by Yamin -->
  <meta name="description" content="Open Source Journal">
  <meta name="keywords" content="bio-science, journal, Bangladesh">
  <meta name="author" content="Md Hassan Shamim">
<!-- SEO Meta Tag end -->
<style>
  .descrip{
    font-size: 10px;
    visibility: hidden;
  }
  </style>
    
    <title>OJS:  
    <?php 
$journal_slug = $_GET['journal'];     
$sql="SELECT * FROM opaar_journal WHERE journal_slug='$journal_slug'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) { $journal_id_get = $journal["id"];
?>    
  
 <?php echo''. $journal["journal_title"].'';
 
}}?>

    </title>



    <link href="../style.css" rel="stylesheet" type="text/css">
     

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script>
      $(document).ready(function() {
        $('.container').addClass('container-loaded');
      });
    </script>
      


<body style = "background: #FBFBFB;">
<div class="container " style = "background: white;">    
    
<?php 
    
$journal_slug = $_GET['journal'];     
$sql="SELECT * FROM opaar_journal WHERE journal_slug='$journal_slug'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) { $journal_id_get = $journal["id"];?>    

<div class = "container " style = "display:inline; ">

<div id="post"> 
<div class="row">

<div class = "col-md-3">
<img  src="image/<?php echo $journal["journal_cover"];?>" id="img_cover" width = "60%">   
</div>  

<div class = "col-md-9">
<b><h3> <?php echo''. $journal["journal_title"].'';?></h3></b>
<p class = "descrip"> <?php echo''. $journal["journal_description"].'';?></p> 
</div>

</div>
</div>

<?php }} else {echo "<div class='col-card' style='padding:10%;'>No Journals Found..</div>";};?>
    
    
    
<!-- <?php 
$sql_article="SELECT * FROM opaar_article where journal_id=$journal_id_get;";
$stmt = $con->prepare($sql_article);   
$stmt->execute();?>                          
    

<?php if ($row = $stmt->fetch()){;?>
<p> Current Issue <br>    
Vol <?php echo''. $row["article_volume"].'';?>                           
No <?php echo''. $row["article_number"].'';?>                           
Year (<?php echo''. $row["article_year"].'';?>)
<br>
Published: <?php echo''. $row["article_date"].'';?> <br></p>
<?php } else{echo"No Current Issue";} ;?>       
    
          
</div></div>           

<div style="clear:both"></div> 
     -->
    
    
    
<div class="col-card">   
<h3> <div class="sep">List Of Article</div></h3> 

<?php 
$sqlm1m="SELECT * FROM opaar_article_users;";
$stmt = $con->prepare($sqlm1m);   
$stmt->execute();  


if ($stmt->rowCount() > 0) {
// output data of each row
while ($row = $stmt->fetch()){ ;?>

<?php 
$sql11="SELECT * FROM opaar_users;";
$stmt = $con->prepare($sql11);   
$stmt->execute();  
while ($what = $stmt->fetch()){ ;?>

     
<?php 
global $id_array,$k;                               
$journal_slug = $_GET['journal']; 
$sql="SELECT * FROM opaar_journal INNER JOIN opaar_article on opaar_journal.journal_slug = '$journal_slug' AND opaar_article.journal_id = opaar_journal.id";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) { 
    
    $id = ''. $journal["id"].'';
    $id_array[$id] = $journal;
    $slug = ''. $journal["journal_slug"].'';
    $slug_array[$slug] = $journal;
    
    ?>  

<?php }}}}};?>    
 
<!-- IMPORTANT-->    
<?php
//for opaar_title loop start    
if(isset($id_array)){     
foreach ($id_array as $k => $meet_dataid) 
{    
$sql="SELECT * FROM opaar_journal INNER JOIN opaar_article ON opaar_article.id = opaar_article.id WHERE opaar_article.id = $k;";
$stmt = $con->prepare($sql);   
$stmt->execute();           
while ($what1 = $stmt->fetch()) {;?>
<div class = "container mt-4">
<div class ="row">
  <!-- <div class = "col-md-3"> -->

<a href="view.php?journal=<?php echo''. $what1["journal_slug"].'';?>&view=<?php echo''. $what1["id"].'';?>">
<h5><?php echo''. $what1["article_title"].'';?></h5>
<!-- <?php echo''. $what1["article_title"].'';?> -->
</a>

<div style="float:right; margin-right:25px;">Published on: <?php echo''.$what1["datetime"].',';?> Vol: <?php echo''.$what1["article_volume"].',';?> No: <?php echo''.$what1["article_number"];?>
</div>    


</div>
</div>
</div>
    
<?php     
//for opaar_title loop end    

//slug start    
foreach ($slug_array as $slug => $meet_slug) 
{ 

$sqlslug="SELECT * FROM opaar_article_users INNER JOIN opaar_users ON opaar_article_users.article_id = opaar_article_users.article_id WHERE opaar_article_users.article_id = '$k';";
$stmt = $con->prepare($sqlslug);   
$stmt->execute(); 
$meet_array = array();
while ($what = $stmt->fetch()) {

$meet_array[$what['article_author']] = $what;  
}  
    
foreach ($meet_array as $article_author => $meet_data) 
{$user ="SELECT * FROM opaar_users where id = $article_author;";
$stmt = $con->prepare($user);   
$stmt->execute();  
while ($what = $stmt->fetch()) {;?>

<h5>Author: <?php echo ''.$what['username'];?>  </h5>

<?php    
}
}
}    

;?>
    
<?php    
    
}    
}} else {echo "<div class='col-card' style='padding:10%;'>No Article Published Yet..</div>";};?>
    
     
</div>
          
</div>
        
        
<!--stop main body post code-->       
        
        </div>
        <?php 
		include "inde/footer.php";
		?>
    </body>
</html>

