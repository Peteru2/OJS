<?php require"site/header.php"; ?>

        
        
<div class="row">
<div class="container-fluid">
<div class="col-12">

    
                                

    
<!--data table start-->
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>ID</th>
                <th>Journal Title</th>
                <th>UserName</th>
                <th>Date</th>
                <th>Status</th>
               
            </tr>
        </thead>
        <tbody>
            
    
                
<?php 

require"function/database.php";
include"engine/function.php";
                
$sql="SELECT * FROM `opaar_users` INNER JOIN opaar_journal on opaar_users.id=opaar_journal.user_id ";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 $i = 1;
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) {;?>
           <tr>  
                <td><?php echo''. $i++ .'';?></td>
                <td><a data-whatever="<?php echo''. $journal["id"].'';?>" data-toggle="modal" data-target="#edit"><?php echo''. $journal["id"].'';?></a></td>
                <td><?php echo''. $journal["journal_title"].'';?></td>
                <td><?php echo''. $journal["username"].'';?></td>
                <td><?php echo''. $journal["journal_date"].'';?></td>
                <td><?php echo''. $journal["journal_status"].'';?></td>
                <!-- <td><a href = "../journal/journal_page.php?<?php echo $journal["journal_slug"] ?>"><?php echo''. $journal["journal_slug"].'';?></a></td> -->

                
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
