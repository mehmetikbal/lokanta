<?php
    //AUthorization - Access control
    //CHeck whether the user is logged in or not
    if(!isset($_SESSION['kadi'])) //IF user session is not set
    {
        //User is not logged in
        //REdirect to login page with message
         $_SESSION['no-login-message'] = "<div class='eror text-center' >Please login to access Admin Panel.</div>";
        //REdirect to Login Page
            header('location:'.SITEURl.'admin/login.php');
    } 
?>