<?php require"site/header.php"; 


?>

<?php if ($_SESSION['usertype'] ==  2):?>
  <head>
    <title>

    Peer Review
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
 Peer Review</button>
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
                <th>Download Article</th>
                <th>Date Submitted</th>
                <th>Article title</th>
                <th>Corrected Art</th>
                <th>AP</th>
                <th>DSP</th>
                <th>Send</th>
                
            </tr>
        </thead>
        <tbody>
            
<?php 
$i ='1';
require"function/database.php";
include"engine/function.php";
// $article_review = $_GET['review'];     
$ses = $_SESSION['id'];

$sql="SELECT * FROM `assign` WHERE peeruser_id = '$ses'  ";
$stmt = $con->prepare($sql);   
$stmt->execute();   


 
if ($stmt->rowCount() > 0) {
    while($paper = $stmt->fetch()) {

        $pap = $paper['article_id'];
       

    $sqli="SELECT * FROM `addpaper` WHERE id = '$pap'";
    $stmtt = $con->prepare($sqli);   
    $stmtt->execute();

        while ($article = $stmtt->fetch()) {;
            $journa_title = $article["journal_id"];
            if($article["status"] == 3):
        ?>
           <tr>   
        
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
                <td><?php echo''. $article["pdf"].'';?>
       <a download = "<?php $article["pdf"];?>" href = "pdf/<?php echo $article["pdf"];?>">Download</a>


                    </td>
                <?php }}; ?>
               
                <td><?php echo''. $article["sub_date"].'';?></td>
               
                <td><?php echo''. $article["Title"].'';?></td>
                <td><?php echo''. $article["paper_corrected"].'';?>
                 <a download = "<?php $article["paper_corrected"];?>" href = "corrected_pdf/<?php echo $article["paper_corrected"];?>">Download</a>


                    </td>
                <td><a href = "approve.php?app=<?php echo $article["id"];?>"  class = "btn btn-success">AP</a></td>
                <td><a href = "disapprove.php?disadd=<?php echo $article["id"];?>"  class = "btn btn-danger">DSP</a></td>

                <?php if($article["correct_paper"] == "No paper for correction yet"): ?>
                <td><a href = "addrev.php?add=<?php echo $article["id"];?>"  class = "btn btn-warning">Send</a></td>

                <?php else: ?>
                            <td>Paper Sent Already</td>
                <?php endif; ?> 
        
            </tr>
            
                
                <?php endif; ?>

    


<?php

              }}} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};
           
            ?>


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
<div>You are not a peer reviewer</div>
<?php endif; ?>

<?php require"site/footer.php"; ?>
