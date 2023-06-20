

<?php require"site/header.php"; 


?>  


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <base href="//papersubmission.scirp.org/"/> -->
<title>Send Paper For correction</title>
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

//  require"site/header.php"; 
$error = '';
$message ='';
$ses = $_SESSION['id'];


$add = $_GET['add'];

if(isset($_POST['submit'])){    
 
$sub_date = $_POST['date'];
$paper_pdf =  $_FILES["fileToUpload"]["name"];
$paper_pdf_tem =  $_FILES['fileToUpload']['tmp_name'];

$target_dir = "temp/";
@$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
@$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if( $paper_pdf == '') {
  $error = "No file was uploaded";
}        

// Check if image file is a actual image or fake image

  elseif($check !== false) {
    // $error= "File is an image - " . $check["mime"] . ".";
    $error= "File is not an .";
  } 


// Check if file already exists
elseif (file_exists($target_file)) {
  $error= "Sorry, file already exists.";
}

// Check file size
elseif (@$_FILES["fileToUpload"]["size"] > 5000000) {
 $error= "Sorry, your file is too large.";
 
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//  $error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

else{   
move_uploaded_file($paper_pdf_tem, "correct_pdf/$paper_pdf");
   
// $sqli = "INSERT INTO `addpaper` ( `correct_paper`,  `check_date`) VALUES (  '$paper_pdf','$sub_date')";
$sqli = "UPDATE addpaper SET correct_paper='$paper_pdf', check_date = '$sub_date',reviewer_id = '$ses' WHERE id = '$add'";
$stm = $con->prepare($sqli);       
$stm->execute(); 
$message = "Corrected paper submitted";

// header("rev.php");

}
}      

?> 

<body onload="checkSubmit()"> 
<div class="head">

   	<div class="ntexst">Online Journal System EksuOyo</div>
     <p class = "text-danger text-center"> <?php echo $error;?>  </p>
     <p class = "text-danger text-center"> <?php echo $message;?>  </p>


</div>
<form id="form1"  method="post" action="addrev.php?add=<?php echo $add; ?>" enctype="multipart/form-data">

<input type="hidden" name="token" id="token" value="odXaSRuryD" />
<textarea style="display: none;" rows="10" cols="10" id="comment" name="comment"></textarea>
<div style="margin:0 auto" id="contentdiv">
	<div id="menu" style="padding:0 0 29px 561px;*padding:0 0 0px 541px;float:inherit;">
		
		
	</div>
<div class="audit_sm" style = "background: #FBFBFB;"> <h4>Resend Paper for correction</h4></div>
<div id="errors" class="err_t"></div>	
  
<div class="account" >
<table width="100%" style = "background: #FBFBFB;" border="0" cellpadding="0" cellspacing="1">
<tr>
    <td>&nbsp;</td>
  
  </tr>

  <!-- mathrma --> 
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
  