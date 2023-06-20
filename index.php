<?php 
require"function/database.php"; 
include"inde/header.php";
$error = '';
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  .pagina{
    margin-top: 10px;
    margin-left: 40%; 
    margin-bottom: 10px;
  }
  
  .stats{
    
    margin-top:20px;
  }
  .words{
    padding-bottom: 5px;
    border-bottom: 2px solid blue;
  }
  .child{
    margin-top: 20px 
  }
  .error{
    color: red;
    text-align: center;
    font-weight: bold;
  }
  @media only screen  and (max-width: 480px){
    .pagina{
    
    margin-left: 40%; 
  
  }}
  <?php
  
  if (isset($_POST['submit'])){

    $email = $_POST['news'];
        if(empty($email)){
            $error = "Email cannot be empty.";
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = "Invalid email format.";
           
          }
          else{
            $query = "INSERT INTO `newsletter` (Email) VALUES ('$email')";
            $join = $con ->query($query);
          }
    
  }
  ?>
</style>

<body style = "background: rgba(239, 239, 250,.6);">


<div class="container" >
<div class = "row">



<div class=" col-xl-8 col-md-7  col-sm-6 mr-2 ml-2" style = "background: white;">
<h5 class = "error"> <?php echo $error; ?></h5>

<?php 
   
$sqlcount="SELECT COUNT(id) from opaar_journal;";
$stmt = $con->prepare($sqlcount);   
$stmt->execute();   
$journal = $stmt->fetch(); 
$limit_page= $journal[0];
$numpage='10';    
$count_page = ceil($limit_page/$numpage);
    
    
@$page = $_GET['page'];  
if (!$page) $page = 0;    
$start = $page * $numpage;

?>    
    
 
<?php 
$sql="SELECT * from opaar_journal ORDER BY id limit $start,$numpage;";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>

 <div class = "col-md-12">
<div class="how-section1 mt-4">

                    <div class="row border-bottom mb-2">
                        <div class="col-md-3 how-img">
                            <img width = "50%" src="image/<?php echo $journal["journal_cover"];?>" class=" img-fluid" alt=""/>
                        </div>
                        <div class="col-md-9">
                        <h4> <?php echo''. $journal["journal_title"].'';?></h4>
                      
                        
                        <p class="text-muted"><?php echo''.substr($journal["journal_description"],0,200).'...'?> </p>
                          <div class="mb-1 text-muted" id="issue"><b>Created on: <?php echo''. $journal["journal_date"].'';?></b></div>
                          <div class="mb-1 text-muted" id="issue"><b>Tags: <?php echo''. $journal["journal_meta"].'';?></b></div>

                        <a  href="journal_page.php?journal=<?php echo''. $journal["journal_slug"].'';?>" class="stretched-link">Check Journal</a>
                        </div>

                    </div>


</div>
</div>   
 
      <?php }} else {
  echo "<div class='col-card' style='padding:10%;'>0 results</div>";
};?>    

</div>

        <div class = "col-xl-3 col-md-4 col-sm-5 ml-4 " style = "background: white;">
        <h4 class = "stats" ><b class = "words">EKSU-OJS STATs</b></h4>
        <h6 class ="child"><b>Publication Years:</b> 2020 till date.</h6>
        <h6 ><b>Publication count: </b> <?php echo $stmt->rowCount()?></h6>
        
   

        <h4 class = "stats"><b class = "words">Make a submittion</b></h4>
          <h5><a href = "signUp.php"><button class = "child btn btn-primary">Submit Paper</button></a></h5>

          <h4 class = "stats"><b class = "words">Social Media</b></h4>
          <div class = "row ">
          <h5><a href = ""><button class = "child ml-3 mr-2 btn btn-primary"><i class = "fa fa-facebook"></i></button></a></h5>
          <h5><a href = ""><button class = "child mr-2 btn btn-primary"><i class = "fa fa-twitter"></i></button></a></h5>
          <h5><a href = ""><button class = "child  mr-2 btn btn-primary"><i class = "fa fa-whatsapp"></i></button></a></h5>
          <h5><a href = ""><button class = "child mr-2 btn btn-primary"><i class = "fa fa-instagram"></i></button></a></h5>
</div>
 
        </div>
</div>

<!--stop main body post code-->               

<div class="pagina">
    
    <a class ="text-white " href="?page=<?php echo $page-1;?>">
    <?php if('page=1'): ?>
      <button class = "btn btn-secondary mr-4 "><h5>Previous &laquo;</h5> </button>
      <?php endif; ?>
    </a>
     
      <a class = "text-white" href="?page=<?php echo $page+1;?>">
        <button class = "btn btn-secondary mr-4"><h5>Next &raquo; </h5></button>
      </a> 
    </div>
        </div>
 </div>
 </div>


<?php 
include"inde/footer.php";
 ?>   
    </body>
    
    
 

</html>

