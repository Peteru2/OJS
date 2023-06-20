

    <?php require"site/header.php"; 

 if ($_SESSION['usertype'] ==  3):?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: Create Password</title>
</head>
<body>

        
        
<div class="row">
<div class="container-fluid">
<div class="col-12">

    
                        
    

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
                
$sql="SELECT * FROM `opaar_users` WHERE password='nil' ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
           <tr>   
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo $i++;?></a></td>
                <td><?php echo''. $journal["id"].'';?></td>
                <td><?php echo''. $journal["username"].'';?></td>
                <td><?php echo''. $journal["password"].'';?></td>
               
                <?php if ($journal["password"] == "nil"): ?>
                <td><button class = "btn btn-warning"><a href = "Pass_c.php?pass=<?php echo''. $journal["id"].'';?>">Create Password<a/></button></td>
                <?php else: ?>
                    <td><button class = "btn btn-success"><a href = "">Password already created<a/></button></td>
                    <?php endif; ?>
                
            </tr>
            <?php }} else {echo "<div class='col-card' style='padding:10%;'>No User to create password for</div>";};?>


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


<?php require"site/footer.php"; ?>

<?php else: ?>
<div>You are not an Administrator</div>


<?php endif; ?>
</body>
</html>



