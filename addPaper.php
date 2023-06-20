




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <base href="//papersubmission.scirp.org/"/> -->
<title>Paper Submission System - Add Paper</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>


<link href="//papersubmission.scirp.org/css/sub.css?ver=20190813" rel="stylesheet" type="text/css"/>
 <script type="text/javascript" src="//papersubmission.scirp.org/js/jquery.js"></script>
 <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"56337940"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");
 </script>
 <style type="text/css">
.head{
  height: 90px;
  background: rgb(231, 216, 219);
  padding: 30px 90px 0px;
  background: -webkit-linear-gradient(bottom,white 0%, #FBFBFB 100% );
    background: -moz-linear-gradient(bottom,white 0%, #FBFBFB  100% );
    background: -o-linear-gradient(bottom,white 0%, #FBFBFB  100% );
    background: linear-gradient(bottom,white 0%, #FBFBFB 100% );

}
.ntexst{
  font-family: ;
  font-size: 30px
}
.btn-sub{
  background: green;
  /* float: right; */
  width: 100px;
  padding: 5px;
  border: none;
  border-radius: 5px;
  color: white;
  margin-top: 10px
}
@media (min-width: 300px) and (max-width: 568px){
    .account table td { font-size:1em; }
    .ntext {width: 100px;}
    #paperpaperAbstract{width:230px;}
    #papertitle{width:230px;}
    #paperKeywords{width:230px;}
    #menu{padding:0 0 29px 15px;}
  	
}

@media (min-width: 1200px)and (max-width: 1700px)  {
    .account table td { font-size:1em; }
     #contentdiv{width:960px;}
     #paperpaperAbstract{width:506px;}
}


</style>
</head>
<?php

require"function/database.php";
include"engine/function.php";

 require"site/header.php"; 
$error = '';
echo $_SESSION['usertype' ];



if(isset($_POST['submit'])){    
$user_id = $_SESSION['id']; 
$u_journal = $_POST['journal_id'];   
$sub_date = $_POST['date'];
$paper_title= $_POST['paper_title'];
$paper_abstract = $_POST['paper_abstract'];
// $paper_keywords = $_POST['paper_keywords'];
$paper_pdf =  $_FILES["fileToUpload"]["name"];
$paper_pdf_tem =  $_FILES['fileToUpload']['tmp_name'];
// $paper_pics =  $_FILES["picsUpload"]["name"];
// $journal_cover2 =  $_FILES['picsUpload']['tmp_name'];
// $journal_fields = $_POST['ck'];
$target_dir = "temp/";
@$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
@$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if(($paper_title == '') or ($paper_abstract == '') or ($paper_pdf == '') or ($u_journal== '') or ($u_journal == '--') ){
  $error = "Please fill up all field";
}        

// Check if image file is a actual image or fake image

  elseif($check !== false) {
    // $error= "File is an image - " . $check["mime"] . ".";
    $error= "File is not an image.";
  } 


// Check if file already exists
elseif (file_exists($target_file)) {
  $error= "Sorry, file already exists.";
}

// Check file size
elseif (@$_FILES["fileToUpload"]["size"] > 500000) {
 $error= "Sorry, your file is too large.";
 
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//  $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

else{   
move_uploaded_file($paper_pdf_tem, "pdf/$paper_pdf");
   
$sqli = "INSERT INTO `addpaper` (`id`, `user_id`, `journal_id`, `Title`, `Abstract`, `pdf`,  `fields`,`status`,`sub_date`,`correct_paper`,`check_date`,`reviewer_id`,`paper_corrected`,paer_c_date) VALUES (NULL, '$user_id', '$u_journal', '$paper_title', '$paper_abstract', '$paper_pdf','sd','3','$sub_date','No paper for correction yet','no date yet','No reviewer yet','No Paper Yet','No date yet')";

$stmt = $con->prepare($sqli);   
$stmt->execute();   
}
}      

?> 

<body onload="checkSubmit()"> 
<div class="head">

   	<div class="ntexst">Online Journal System EksuOyo</div>
     <p class = "text-danger text-center"> <?php echo $error;?>  </p>

</div>
<form id="form1"  method="post" action="addPaper.php" enctype="multipart/form-data">

<input type="hidden" name="token" id="token" value="odXaSRuryD" />
<textarea style="display: none;" rows="10" cols="10" id="comment" name="comment"></textarea>
<div style="margin:0 auto" id="contentdiv">
	<div id="menu" style="padding:0 0 29px 561px;*padding:0 0 0px 541px;float:inherit;">
		
		
	</div>
<div class="audit_sm" style = "background: #FBFBFB;">Paper submission (<font color="#ff0000">*</font> are required fields.)
<br/>

Please contact us via this email <a href="mailto:polalekan526@gmail.com"><font color="red">polalekan526@gmail.com</font></a>  if there is difficulty during submission.
</div>
<div id="errors" class="err_t"></div>	
  
<div class="account" >
<table width="100%" style = "background: #FBFBFB;" border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>&nbsp;</td>
  
  </tr>
<tr>
     <td>Journal</td>
         
    <td id="sj">
  
<div class="input-group mb-3">
        <div class="input-group-prepend ">
        <span class="input-group-text" id="basic-addon3">OJS Journals(OJS) &nbsp;&nbsp;&nbsp;&nbsp; Select Journal</span>
        </div>

        <select name="journal_id" required>   
        <option value="">--</option>     
        <?php 
        $sql="SELECT * from opaar_journal;";
        $stmt = $con->prepare($sql);   
        $stmt->execute();   
        if ($stmt->rowCount() > 0) {
        // output data of each row
        while ($journal = $stmt->fetch()) {;?>
        <option width = "1000px"value="<?php echo''. $journal["id"].'';?>"><?php echo''. $journal["journal_title"].'';?></option>  
        <?php }};?>
        </select>  
        </div>

    <td>
  </tr>
  <!-- mathrma -->


  <tr>
    <td><font color="#ff3300">*</font> Manuscript Title</td>
    <td><input name="paper_title"  type="text" maxlength="480" style = "width: 500px" value="" class="account_input_lag" /><font color="red"><label for="papertitle"  id="titleMessage"></label>
    </font></td>
  </tr>
  <tr>
    <td><font color="#ff3300">*</font> Abstract</td>
    <td><textarea   name="paper_abstract" rows="8"  id="paperpaperAbstract" onkeyup="document.getElementById('num').innerHTML=this.value.length+'/2900';"    ></textarea><font id="num" >0/2900</font><font color="red"><label for="paperpaperAbstract"  id="abstractMessage"></label></font></td>
  </tr>
 
<!-- <input type="hidden" name="paper.pageCount" value="1" id="paperpaerCount"/> -->

  <tr>
    <td><font color="#ff3300">*</font> Paper File</td>
    <td><input type="file" name="fileToUpload"  id="doc" onchange="filesize(this,0)" /><font color="red"><label for="doc"  id="docMessage"></label></font>
    <!-- <input type="hidden" name="fileError" id="fileError" value="0" /> -->
    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
    <font color=red>doc,docx,pdf,zip,rar</font> formats are accepted. Maximum file size: <font color=red>10 MB</font>.
    </td>
  </tr>
  <!-- <tr>
    <td>Graphic Files</td>
    <td><input type="file" name="picsUpload"  id="doc2"  onchange="filesize(this,1)"  /><font color="red"><label for="doc2"  id="doc2Message"></label></font>
    <input type="hidden" name="file2Error" id="file2Error" value="0" />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <font color=red>jpg,jpeg,gif,png</font> formats are accepted. Maximum file size: <font color=red>20 MB</font>. <br/>(Before uploading multiple figures, please compress them into a .zip or .rar file.) 
    </td>
        </tr> -->
        <tr>
          
          <td for="company" class="form-control-label">Date:</td> 
          
    <td>
<div class="card">
<div class="card-body">
<input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required>
        </div>
        </div>
    </td>
  </tr>
 <tr>
  <td>
  <td colspan="2"  bgcolor="#ffffff" align="center"><input type="submit" name = "submit" value="Submit" class="login_sub"/></td>
        </td>
 </tr>
   
</table>
</div>
</form>
<!-- Synchronous submit an article -->

<!--End of Zopim Live Chat Script-->

   </body>
   

</html>
  