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
                <th>Journal Id</th>
                <th>User Id</th>
                <th>Under</th>
                <th>Download Article</th>
                <th>Date Submitted</th>
                <th>Article title</th>
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
$article_review = $_GET['review'];     
$ses = $_SESSION['id'];

$sql="SELECT * FROM `assign` WHERE id = '$ses'  ";
$stmt = $con->prepare($sql);   
$stmt->execute();   

echo $sql;
 
if ($stmt->rowCount() > 0) {
    while($paper = $stmt->fetch()) {

        $pap = '7';
        echo $pap;

    $sqli="SELECT * FROM `addpaper` WHERE journal_id = '$article_review' AND id = '$pap' ";
    $stmtt = $con->prepare($sqli);   
    $stmtt->execute();
// output data of each row
while ($article = $stmtt->fetch()) {;?>
           <tr>   
            <?php
            $journa_title = $article["journal_id"];
            // echo $journa_title;
            ?>
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo $i++;?></a></td>
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
            
            
                <td>AP</td>
                <td>DSP</td>
                <td>Send</td>


              
                
            </tr>
            <?php }}} else {echo "<div class='col-card' style='padding:10%;'>0 results</div>";};?>


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
