<?php 
 

require"site/header.php"; 
if ($_SESSION['usertype'] ==  3):


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJS: All Articles</title>
</head>
<body>

        
        
<div class="row">
<div class="container-fluid">
<div class="col-12">

    
                        
    

  <div class="card" style="margin-top: 1%;">
    <div class="card-body">
      
  
                  
    
        
        
        
<ol class="breadcrumb mb-4" >                 
<!-- Button trigger modal start -->
<button type="button" class="btn-md btn-primary right" data-toggle="modal" data-target="#edit" >
 All Articles</button></ol>


         <div class="dash">

            </div>
        
        
    </div>
  </div>
</div>                   
            
        
        
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
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Article Title</th>
                <th>UserName</th>
                <th>Date</th>
                <th>Status</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
            
    
                
<?php 
$i ='1';
require"function/database.php";
include"engine/function.php";
                
$sql="SELECT * FROM `opaar_users` INNER JOIN opaar_journal on opaar_users.id=opaar_journal.user_id ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
           <tr>   
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo $i++;?></a></td>
                <td><?php echo''. $journal["journal_title"].'';?></td>
                <td><?php echo''. $journal["username"].'';?></td>
                <td><?php echo''. $journal["journal_date"].'';?></td>
                <td class = "btn btn-success"> Published</td>
                <td><?php echo''. $journal["user_ip"].'';?></td>
                
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


<?php require"site/footer.php"; ?>
<?php else: ?>
<div>You are not an Administrator</div>
<?php endif; ?>
</body>
</html>