

<?php
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\Exception;

//  require 'phpmailer/src/Exception.php';
//  require 'phpmailer/src/PHPMailer.php';
//  require 'phpmailer/src/SMTP.php';


 require"site/header.php"; 

if ($_SESSION['usertype'] ==  3):
    $message = '';
?>



       
       
<div class="row">
<div class="container-fluid">
<div class="col-12">

  
          <div>
            
          <p><h4 class = "text-danger">Note that the password cannot be updated again after you have updated it.</h4></p>
        </div>             
   

 <div class="card" style="margin-top: 1%;">
   <div class="card-body">
           
<!--  modal end -->

<!--data table start-->
   <table id="example" class="table table-striped table-bordered" style="width:100%">
       <thead>
           <tr>
               <th>ID</th>
               <th>User ID</th>
               <th>Username</th>
               <th>Password</th>
               <th>Action</th>


           </tr>
       </thead>
       <tbody>
               
<?php 
$i ='1';
require"function/database.php";
include"engine/function.php";

$Pass = $_GET['pass'];        
$sql="SELECT * FROM `opaar_users` WHERE id='$Pass' ";
$stmt = $con->prepare($sql);      
$stmt->execute(); 

if(isset($_POST['Update'])){  


    $sql="SELECT * FROM `opaar_users` WHERE id='$Pass' ";
    $stmt = $con->prepare($sql);   
    $stmt->execute(); 
    if ($stmt->rowCount() > 0) {
        // output data of each row
        while ($journal = $stmt->fetch()) {

            
            $rand = rand(1000,10);
            $rand1 = rand(100,10);

            $user = $journal["username"];
            $user = substr($user, 0, 6);
            $get_pass = $rand1."-".$user.$rand;
            trim(str_replace(' ','',$get_pass));

    $sqli = "UPDATE opaar_users SET password='$get_pass' WHERE id = '$Pass';";
    $stm = $con->prepare($sqli);   
    $stm->execute(); 

    $message = "Password succesfully updated";


    // $subject = "Account Verification";
    // $message_body = "
    //                  Hello '.$user.',
         
    //                  Thank you for signing up as a reviewer!
    //                 Your Cv
                    
    //          http://localhost/E-Farm-Mana/Login/verify.php?email=".$email."&hash=".$hash;
                     
                    
    //           $mail = new PHPMailer(true);       
    //           $mail -> isSMTP();
    //           $mail ->Host ='smtp.gmail.com';
    //           $mail->SMTPAuth = true;

    //           $mail->Username = "efarm2023@gmail.com";
    //           $mail->Password = "zwophkdrfdzkbgon";
    //           $mail->SMTPSecure = 'ssl';
    //           $mail->Port = 465;

    //           $mail->setFrom('efarm2023@gmail.com');
    //           $mail->addAddress($email);
    //           $mail->isHTML(true);
    //           $mail->Subject = $subject;
    //           $mail->Body = $message_body;
              
    //           $mail-> send();

  }

    }}
if ($stmt->rowCount() > 0) {
    
// output data of each row
while ($journal = $stmt->fetch()) {
    $id1 = $journal["id"];
        
    ?>

          <tr>   
               <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo $i++;?></a></td>
               <td><?php echo''. $journal["id"].'';?></td>
               <td><?php echo''. $journal["username"].'';?></td>
               <td><?php echo''. $journal["password"].'';?></td>

               <form   method="post"  action = "Pass_c.php?pass=<?php echo $Pass;?>" enctype="multipart/form-data">
               <?php if ($journal["password"] == "nil"): ?>
               <td><input type = "submit" name = "Update" value = "Update Password" class = "btn btn-success"><a style = "color: white; text-decoration: none"href = ""></td>
                   <?php endif; ?>
               </form>

               
           </tr>
           <?php }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>


       </tbody>
      
   </table>
   
   
   <p><h4 class = "text-success"><?php echo $message;?></h4></p>

   <!--data table end-->
      
<script>
   $('#edit').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var recipient = button.data('whatever') // Extract info from data-* attributes
         var modal = $(this);
         var dataString = 'id=' + recipient;

           $.ajax({
               type: "GET",
               url: "editdata.php",
               data: dataString,
               cache: false,
               success: function (data) {
                   console.log(data);
                   modal.find('.dash').html(data);
               },
               error: function(err) {
                   console.log(err);
               }
           });
   })
</script>       
       
       
</div>

</div>

     </div> </div> </div>


<?php require"site/footer.php"; ?>

<?php endif; ?>




