<?php
//include constants.php file here
include('..\config\constants.php');



//1.get to id of admin to be deletd
        //echo $admin_id = $_GET['admin_id']  delet id kontrolu
        $admin_id = $_GET['admin_id'];


//2.creat sql query to delet admin 
    $sql = "DELETE FROM tbl_admin WHERE admin_id=$admin_id";

    //execute the query 
    $res = mysqli_query($conn,$sql);

    //checek whether the query execute successfully or not 
    if($res==true)
    {
        //query executed successlly and admin deleted 
            //echo "admin deleted";
        //create session variable to display message
            $_SESSION['delete'] = "<div class='success'>admin deleted successfullay.</div> "; 
            //redirect to manage admin page
                header('location:'.SITEURl.'admin/admin.php');    
    }
    else
    {
        //failed to delete admin
            // echo "failed to delete admin ";
            $_SESSION['delete'] = "<div class='eror'>failed to delete admin . try again leter.</div>";
            header('location:'.SITEURl.'admin/admin.php');    

    }

//3.redirect to manage admin page with message (succss/eror)






?>