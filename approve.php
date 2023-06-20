<?php 


?>

<?php require"site/header.php"; 

?>

<?php if ($_SESSION['usertype'] ==  2):?>
  <head>
    <title>
   Approve Article   
  </title>

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
 Assign REview</button>
</ol>          
<!--  modal end -->
<!--data table start-->
    <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Article Id</th>

                <th>Journal Id</th>
                <th>User Id</th>
                <th>Under</th>
               
                <th>Date Submitted</th>
                <th>Article title</th>
                <th>AP</th>
                
                
            </tr>
        </thead>
        <tbody>
            
<?php 
$i ='1';
require"function/database.php";
include"engine/function.php";

$add = $_GET['app'];   
  if(isset($_POST['approve'])){    
                $sqlli = "UPDATE addpaper SET status = 1 WHERE id = '$add'";
                $stmtt = $con->prepare($sqlli);   
                $stmtt->execute();  
            }

$sql="SELECT * FROM `addPaper` WHERE id = '$add'  ";
$stmt = $con->prepare($sql);   
$stmt->execute();   

if ($stmt->rowCount() > 0) {
    while($article = $stmt->fetch()) {

       if ($article['status'] == 3):

            
          
            
            // if(isset($_POST['disapprove'])){    
            //     $sqlli = "UPDATE addpaper SET status = 2 WHERE user_id = '$add'";
            //     $stmtt = $con->prepare($sqlli);   
            //     $stmtt->execute();  
            // }
            
        
        ?>
           <tr>   
            <?php
            $journa_title = $article["journal_id"];
            ?>
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo $i++;?></a></td>
                <td><?php echo''. $article["id"].'';?></td>
            
                <td><?php echo''. $article["journal_id"].'';?></td>
                <td><?php echo''. $article["user_id"].'';?> </td>

                <?php 
                $squi = "SELECT * FROM opaar_journal WHERE id='$journa_title' ";
                $stm = $con->prepare($squi); 
                $stm->execute();

                if ($stm->rowCount() > 0 ){
                    while ($journal = $stm->fetch()) {;
                    ?>
                
                <td><?php echo''. $journal["journal_title"].'';?> - journal</td>
                

                    </td>
                <?php }}; ?>
                
                <td><?php echo''. $article["sub_date"].'';?></td>
                <td><?php echo''. $article["Title"].'';?></td>
            
                <form action = "approve.php?app=<?php echo $article["id"];?>" method = "post" >
              
                    <td><input class = "btn btn-success" type = "submit" name = "approve" value = "AP"></td>
                    
                    </form>
               <div class = "mb-4">
               <h4> <b>Are you sure you want to approve?</b></h4>
                <div>
                


              
                
            </tr>
           
        
        <?php endif;
    
     if ($article['status'] == 1):?>
      <div>This has already been approved</div>
    <?php endif; ?>

    <?php if ($article['status'] == 2):?>
      <div>This has already been disapproved</div>
    <?php endif; 
    
    
    }} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>

           

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
<?php endif; ?>

<?php require"site/footer.php"; ?>
