<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP</title>
    
<?php 
session_start();
require"function/database.php";

$message = ""; 
$error ="";

if(isset($_POST['submit'])){
   
$username = $_POST['username'];
// $id = $_POST['user_id'];
// $password = $_POST['password'];
$email = $_POST['email'];
$number = $_POST['number'];
$user_type = 2;


$num_len = strlen($number);
    
 //for count
 $sql = "SELECT * FROM opaar_users WHERE email='$email' ";    
 $stmt = $con->prepare($sql);   
 $stmt->execute();       
 $row = $stmt->fetch();

if(($username == '') or ($email == '') or ($number == '')){
    $message = "Please fill up all field";
}        
 elseif($num_len != 11){
    $message = "Phone number not valid";
 }
else{   

    $sqli = "INSERT INTO opaar_users (username, password, mobileno, email, usertype) VALUES ('$username','nil','$number','$email','$user_type')";
    $stmt = $con->prepare($sqli);   
    $stmt->execute();
    
    // mysqli_query($con, $sqli);

    // $sqli = "INSERT INTO members (Name, Username, Password, Hash, Mobileno, Email)
    // VALUES ('$name','$user','$pass','$hash','$mobile','$email')";
    // mysqli_query($conn, $sqli);

    header('location: login.php');

} 
    
}
;?>   

    <!--Start-->
    <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
     <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--End Boostrap-->

  <link href="assets/css/login.css" rel="stylesheet">

 
    
        
</head>
    
<body>
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4  col-xs-0 login-sec">
    <p class = "text-secondary">   <?php echo $message; ?>  </p>
        <p class = "text-danger">   <?php echo $error;?>  </p>

		    <h2 class="text-center">Sign Up As Peer</h2>

              
            
<form class="signUp-form" method="POST" action="peer.php">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Name</label>
    <input type="text" name="username" class="form-control" placeholder="">
    
  </div>  

  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Email</label>
    <input type="email" name="email" class="form-control" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Phone Number</label>
    <input type="number" name="number" class="form-control" placeholder="">
  </div>
  
  
  <div class="form-group">
        Send CV to <a href = " mailto:polalekan526@gmail.com">polalekan526@gmail.com</a>
  </div>
  <div class="form-group">
    Your Password will be sent to you through mail, after you have been deemmed fiited to be a peer reviewer
  </div>
  
     <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" name="submit" class="btn btn-login float-right">Submit</button>
    <h5 class="mt-4">Signed up already - <a href="login.php">Login</a></h5>
  </div>
        

</form>
            
            
            
<div class="copy-text">OJS Admin Panel</div>
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
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" style = "repeat: no-rep"alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2><b>OJS</b></h2>
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
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
        <h2>Anaïs Nin:</h2>
            <p>If you do not breathe through writing, if you do not cry out in writing, or sing in writing, then don’t write, because our culture has no use for it.</p>        </div>	
        </div>	
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>
    </section>


</body>
</html>