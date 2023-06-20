<?php 

require"site/header.php"; 

 if ($_SESSION['usertype'] ==  3):?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: All Users</title>
</head>
<body>

<?php

// echo $profid;
?>  
<div class="row">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card" style="margin-top: 1%;">
            <div class="card-body">
                        
           <h5 class="card-title m-2">All registered users.</h5>
            
    <script> document.querySelector('.sweet-12').onclick = function success(){
        swal({
          title: "Added",
          text: "New user has been added successfully",
          type: "success",
          showCancelButton: true,
          confirmButtonClass: 'btn-success',
          confirmButtonText: 'done!'
        });
      };
    </script>            
            
<!--  modal end -->

        
    
<!--data table start-->
    <table id="example" class="table table-striped table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>Username</th>
                <th>PAssword</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Usertype</th>
            
                <!-- <th>IP</th> -->
              

            </tr>
        </thead>
        <tbody>
               
<?php 

require"function/database.php";
include"engine/function.php";
               
// $profid = $_GET['user_id'];

$sql="SELECT * FROM `opaar_users`  ";
$stmt = $con->prepare($sql);   
$stmt-> execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
$i = 1;
while ($users = $stmt->fetch()) {;
?>

           <tr>   

                <td><?php echo''. $i++ .'';?></td>
                <td><a data-whatever="<?php echo''. $users["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo''. $users["id"].'';?></a></td>
                <td><?php echo''. $users["username"].'';?></td>

                <td><?php
                $str = $users["password"];
                 
                  echo''.$str.'';?></td>
                <td><?php echo''. $users["email"].'';?></td>
                <td><?php echo''. $users["mobileno"].'';?></td>
                
              
                <?php if( $users["usertype"] == 1): ?>
                <td class = "bg-success text-white"> <h5>Author/Contributor</h5></td>
                <?php endif; ?>
                <?php if( $users["usertype"] == 2): ?>
                <td class = "bg-danger text-white"> <h5>Peer Reviewer</h5></td>
                <?php endif; ?>
                <?php if( $users["usertype"] == 3): ?>
                    <td class = "bg-warning text-white"> <h5>Admininstrator</h5></td>
                <?php endif; ?> 
        
               
            </tr>
            <?php
             }
        } 
        else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>

        </tbody>       
    </table>
    
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

      </div>
     </div>
 </div>
 

<?php require"site/footer.php"; ?>
<?php else: ?>
<div>You are not an Administrator</div>
<?php endif; ?>

</body>
</html>