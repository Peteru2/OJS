
<?php
//print_r($_POST);    
require"function/database.php";
include"engine/function.php";?>

<?php require"site/header.php";


?>


<?php if(isset($_GET['welcome'])){;?>

<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> You have been signed in successfully!
</div>


<script>window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);</script>
    
<?php };?>



<br>
    
<?php 
           
$sql="SELECT * FROM `opaar_users` INNER JOIN opaar_journal on opaar_users.id=opaar_journal.user_id ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
$journal = $stmt->fetch(); {;?>    

    
<div class="container">

<div class="card">
  <div class="card-header">
 Hi! <?php echo strtoupper($_SESSION['username']);?>

  </div>
  <div class="card-body">
    <h5 class="card-title">Welcome to OJS EksuOyo</h5>
    <p class="card-text">We see your are logged in with "<?php echo''. $journal["user_ip"].'';?>
" IP address. <br>We have saved it for future security propose.<br> 

<?php if ($_SESSION['usertype'] ==  1):?>
    <br>Do you want to create you first article on opaar?</p> 
    <a href="addpaper.php" class="btn btn-primary">Submit your paper</a>
    <?php endif ?>
    <?php if ($_SESSION['usertype'] ==  3):?>
    <br>Do you want to create you first article on opaar?</p> 
    <a href="post.php" class="btn btn-primary">Create journal </a>
    <?php endif ?>

  </div>
</div>
</div>


<?php }};?>

<?php require"site/footer.php";?>



