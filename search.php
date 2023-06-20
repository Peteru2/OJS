<?php 
require"function/database.php"; 
include"inde/header.php";
?>
    

<body>
<div class="container">
<!--start main body post code-->        
<div class="col-main">
<?php 
   
$sqlcount="SELECT COUNT(id) from opaar_journal;";
$stmt = $con->prepare($sqlcount);   
$stmt->execute();   
$journal = $stmt->fetch(); 
$limit_page= $journal[0];
$numpage='5';    
$count_page = ceil($limit_page/$numpage);
    
@$page = $_GET['page'];  
if (!$page) $page = 0;    
$start = $page * $numpage;
?>    
    
    
<?php 
$yserch = "";
if(isset($_POST['submit'])){
     $searc =  $_POST['search'];
        // echo $searc;


// $sql="SELECT * FROM `opaar_journal` INNER JOIN opaar_article  WHERE journal_meta OR  article_tags LIKE '%$searc%' ";


        $sql = "SELECT * FROM opaar_journal  WHERE journal_title LIKE '%$searc%' OR journal_meta LIKE '%$searc%' OR journal_description LIKE '%$searc%' ";
        $stmt = $con->prepare($sql);   
        $stmt->execute();   
         if (empty($searc)){
          $yserch = " <h5><p class = ' '> </br>Sorry, the field was empty.</p></h5>";
         }
        elseif ($stmt->rowCount() == 0) {
        // output data of each row
        $yserch = " <h5><p class = ' '> </br>Sorry, no result was found pertaining to your search.</p></h5>";
      }
      else{  
        while ($journal = $stmt->fetch()) {;

?>

<main class="container ">

    <div class="row mb-2">

    <div class="col-md-12">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">
          <?php echo''. $journal["journal_title"].'';?>
          </strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted" id="iz ssue"><b>The submitted date: <?php echo''. $journal["journal_date"].'';?></b></div>
          <div class="mb-1 text-muted" id="issue"><b>Published on: <?php echo''. $journal["journal_date"].'';?></b></div>

          <p class="card-text mb-auto"> <?php echo''. substr($journal["journal_description"],0,200).'..'?> </p>
          <a  href="journal_page.php?journal=<?php echo''. $journal["journal_slug"].'';?>" class="stretched-link">Check journal </a>
        </div>
        <div class="col-auto d-none d-lg-block">
        <img src= "image/<?php echo $journal["journal_cover"];?>" id="img_cover"class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><img x="50%" y="50%" fill="#eceeef" dy=".1em">    

         <!-- <svg class="bd-placeholder-img" width="200" height="250" xmlns="../image/<?php echo $journal["journal_cover"];?>" id="img_cover" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>      -->
       
        </div>
      </div>
    </div>
</div>
</div>

</main>
                 
         
      <?php }}} 
;?>
            <div class = "text-center text-danger"><?php echo $yserch;?></div></div>
<!--stop main body post code-->               
       
        </div>
<div class="container mb-3">
<div class="pagination">
    

<a class ="text-white " href="?page=<?php echo $page-1;?>">
  <button class = "btn btn-secondary mr-4 "><h5>Previous &laquo;</h5> </button>
</a>
 
  <a class = "text-white" href="?page=<?php echo $page+1;?>">
    <button class = "btn btn-secondary mr-4"><h5>Next &raquo; </h5></button>
  </a>
   

    
</div>
 </div>


<?php 
include"inde/footer.php";
 ?>   
    </body>
    
    
 
 </div>
</html>

