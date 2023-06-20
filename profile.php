<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: Profile</title>
</head>
<body>
    

<?php
//print_r($_POST);    
require"function/database.php";
include"engine/function.php";?>

<?php require"site/header.php";?>


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
  <?php echo strtoupper($_SESSION['username']);?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Your Profile</h5>
  
    
    <a href=".php" class="btn btn-primary">Change Profile settings</a>
    <!-- <a href="editdata.php" class="btn btn-primary">Edit</a> -->

    <a href="myPost.php" class="btn btn-primary">View my posts</a>

  </div>
</div>
</div>


<?php }};?>

<?php require"site/footer.php";?>




</body>
</html>