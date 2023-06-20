<?php
require"function/database.php"; 
include"inde/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Administrators</title>

    <style>
        .about-page {
    font-weight: bold;
    font-family: san serif;
    font-size: 20px;
    box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 20%);
    padding: 10px;
    margin-bottom: 10px
}
.guide{
    font-family: Georgia, Arial and Helvetica;
    padding: 10px;
    border: 1px solid blue;
}
li, div, p{
    margin-bottom: 6px
}
@media only screen and (max-width: 480px){
.about-page {
    box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 20%);
    padding: 10px;
}}
        </Style>
</head>


<body style = "background: rgba(239, 239, 250,.6);">
    <div class = "container " style = "background: white;">
        <div class = "about-page">
<h3 class = "text-center guide">For Administrators</h3>
<p>
Welcome to the Administrator Page, your central hub for managing the journal publication system. As an administrator, you play a crucial role in ensuring the smooth operation and integrity of the publication process. Here are some key responsibilities and functionalities available to you:
</p>
<ol>
    <li>User Management: You have the authority to manage user accounts, including creating password for reviewers, as well as updating user information and permissions.</li>

<li>Manuscript Tracking: The system provides you with comprehensive tools to track the progress of submitted manuscripts. You can view and manage the status of manuscripts, assign them to appropriate editors and reviewers, and monitor the review process.</li>

<li>Editorial Workflow: You have the power to oversee the editorial workflow from manuscript submission to final publication. This includes making decisions on manuscript acceptance, rejection, or revision, communicating with authors and reviewers, and ensuring timely and transparent communication throughout the process.</li>

<li>System Configuration: The administrator page allows you to configure and customize various settings of the publication system. You can manage templates for manuscript formatting, set up review criteria, define publication schedules, and adapt the system to suit the specific needs of your journal.</li>

<li>Analytics and Reporting: Gain valuable insights into the performance of the publication system through comprehensive analytics and reporting features. You can access usage statistics, and other data to assess the impact and reach of published articles. </li>



<div>We are here to support you in utilizing the administrator functionalities effectively. If you have any questions, concerns, or require assistance, please don't hesitate to reach out to our support team.</div>

<p class = "text-center">Thank you for your dedication to maintaining the highest standards of scholarly publishing. Your efforts contribute to the advancement of knowledge and the dissemination of valuable research.</p>   

</ol>

</div>
</div>




<?php 
include"inde/footer.php";
 ?>  

</body>
</html>