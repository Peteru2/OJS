
<?php 
session_start();
require"function/database.php";

$message = ""; 
$error ="";

if(isset($_POST['submit'])){

$email = $_POST['email'];   
$username = $_POST['username'];
$password = $_POST['password'];
    
$sql = "select * from opaar_users where username ='$username' and email = '$email' and password = '$password'";    
$stmt = $con->prepare($sql);   
$stmt->execute();       
    
if(($username == '') or ($password == '') or ($email == "")){
    $message = "Please fill up all field";
}    

    
$row = $stmt->fetch(); //for count
    
if($row > 0) {    
$_SESSION['email'] = $_POST['email'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['id'] = $row['id']; 
$_SESSION['usertype'] = $row['usertype'];
    
header('location: dashboard.php?welcome=login');    
} 

 else{
 $error ="Incorrect info"; 
 }   
    
}
;?>   





<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OJS: Login</title>

  

    <!--Start-->
    <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
     <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--End Boostrap-->

  <link href="assets/css/login.css" rel="stylesheet">

 
    
 
</head>
    
    
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>

              
            
<form class="login-form" method="POST" action="login.php">
<div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" name="username" class="form-control" placeholder="">
    
  </div>  
<div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">email</label>
    <input type="email" name="email" class="form-control" placeholder="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" name="password" class="form-control" placeholder="">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" name="submit" class="btn btn-login float-right">Submit</button>

    
  </div>
  <button type="button" name="" class="btn btn-success col-md-12 mt-2"><a href = "Sign_to_sign.php" class = "text-white" style = "text-decoration: none">Sign Up</a></button>
  <p class = "text-secondary">   <?php echo $message; ?>  </p>
        <p class = "text-danger">   <?php echo $error;?>  </p>

      

</form>
            
            
            
<div class="copy-text">EKSU-OJS</div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-tarPOST="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2><b>EKSU-OJS</b></h2>
            <p>Journal writing, when it becomes a ritual for transformation, is not only life-changing but life-expanding.</p>
        </div>	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Virginia Woolf</h2>
            <p>Every secret of a writer’s soul, every experience of his life, every quality of his mind, is written large in his works.</p>
        </div>	
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Anaïs Nin:</h2>
            <p>If you do not breathe through writing, if you do not cry out in writing, or sing in writing, then don’t write, because our culture has no use for it.</p>
        </div>	
    </div>
  </div>

            </div>	   
		    
		</div>
	</div>
</div>
</section>
    
        
            
    
    
    
    </section></html>

