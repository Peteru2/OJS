<?php 

require"site/header.php"; 

 if ($_SESSION['usertype'] ==  1):?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: My Post</title>
</head>
<body>

<?php
// echo  $_SESSION['id'];
  $sid = $_SESSION['id'];


// echo $profid;
?>  
<div class="row">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card" style="margin-top: 1%;">
            <div class="card-body">
                        
           <h5 class="card-title m-2">All your submitted Papers</h5>
            
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
                <th>Journal ID</th>
                <th>Article Title</th>
                <th>Author</th>
                <th>Paper Submited</th>
                <th>Date Submtted</th>
                <th>Status</th>
                <th>Paper for correction</th>
                <th>Send</th>

                <!-- <th>IP</th> -->
              

            </tr>
        </thead>
        <tbody>
               
<?php 

require"function/database.php";
include"engine/function.php";
               
// $profid = $_GET['user_id'];

$sql="SELECT * FROM `opaar_users` INNER JOIN addpaper on opaar_users.id=addpaper.user_id WHERE `User_id` = $sid ";
$stmt = $con->prepare($sql);   
$stmt-> execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
$i = 1;
while ($journal = $stmt->fetch()) {;
?>

           <tr>   

                <td><?php echo''. $i++ .'';?></td>
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo''. $journal["id"].'';?></a></td>
                <td><?php echo''. $journal["journal_id"].'';?></td>
                <td><?php echo''. $journal["Title"].'';?></td>
                <td><?php echo''. $journal["username"].'';?></td>
                <td><?php echo''. $journal["pdf"].'';?>
       <a download = "<?php $journal["pdf"];?>" href = "../pdf/<?php echo $journal["pdf"];?>">Download</a>
             
            </td>
                
                <td><?php echo''. $journal["sub_date"].'';?></td>
                <?php if( $journal["status"] == 1): ?>
                <td class = "bg-success text-white"> <h5>Approved</h5></td>
                <?php endif; ?>
                <?php if( $journal["status"] == 2): ?>
                <td class = "bg-danger text-white"> <h5>Dissaproved</h5></td>
                <?php endif; ?>
                <?php if( $journal["status"] == 3): ?>
                    <td class = "bg-warning text-white"> <h5>Pending</h5></td>
                <?php endif; ?> 
                <?php if( $journal["status"] == 4): ?>
                    <td class = "bg-secondary text-white"> <h5>Published</h5></td>
                <?php endif; ?>

                <?php if( $journal["status"] == 3): ?>
                <td>
                <?php  
                     echo''. $journal["correct_paper"].'';
                ;?>
       <a download = "<?php $journal["correct_paper"];?>" href = "../correct_pdf/<?php echo $journal["correct_paper"];?>">Download</a>
                </td>
                <?php else: ?>
                   <td> Paper already corrected or disapproved
                   <a download = "<?php $journal["correct_paper"];?>" href = "../correct_pdf/<?php echo $journal["correct_paper"];?>">Download</a></td>
                <?php endif; ?> 

                <?php if($journal["paper_corrected"] == "No Paper Yet" ): ?>
                <td><a href ="resend.php?resend=<?php echo $journal['id'];?>">Send</a></td>
              
                <?php else: ?>
                            <td>No paper to correct or paper already sent</td>
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
 <?php else: ?>
<div>You are not an Authur</div>
<?php endif; ?>

<?php require"site/footer.php"; ?>

</body>
</html>