<?php 
require"site/header.php"; 
if ($_SESSION['usertype'] ==  3):?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: Assign Article</title>
</head>
<body>


<div class="row">
<div class="container-fluid">
<div class="col-12">

    
                                
<ol class="breadcrumb mb-4" >                 
<!-- Button trigger modal start -->
<button type="button" class="btn-md btn-primary right" data-toggle="modal" data-target="#edit" >
 Assign article to review</button>
</ol>
       
    
<!--data table start-->
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>S/N </th>
            <th>User ID</th>
                <th>Peer Reviewer Username</th>
                <th>Assign for reviewer</th>

              
               
            </tr>
        </thead>
        <tbody>
            
    
                
<?php 

require"function/database.php";
include"engine/function.php";

$user_type = 2;
$sql="SELECT * FROM `opaar_users` WHERE usertype = '$user_type'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 $i = 1;
if ($stmt->rowCount() > 0) {
// output data of each row
while ($user = $stmt->fetch()) {;?>
           <tr>  
            
                <td><?php echo''. $i++ .'';?></td>
                <td><a data-whatever="<?php echo''. $user["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo''. $user["id"].'';?></a></td>
                <td><?php echo''. $user["username"].'';?></td>
                <td><a  href="ass_art.php?assign=<?php echo''. $user["id"].'';?>" class="stretched-link">Assign article for this reviewer</a> </td>          
            </tr>
            <?php }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>


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





      </div> </div> </div>
      <?php else: ?>
<div>You are not an Administrator</div>
<?php endif; ?>
</body>
</html>