<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>update Admin</h1>
        <br>

      <?php
    //1. Get the ID of selected Admin
        $admin_id=$_GET['admin_id'];

    //2. Create SQL Query to Get the Details
    $sql="SELECT * FROM  tbl_admin WHERE admin_id=$admin_id ";

                 //Execute the Query
              $res=mysqli_query($conn, $sql);

                    //check whether the query is executed or not
                    if($res==true)
                {
                    // Check whether the data is available or not
                    $count = mysqli_num_rows ($res);
                //check whether we have admin data or not
                    if($count==1)
                 {
                     // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    $adi_soyadi =$row['adi_soyadi'];
                    $kadi =$row['kadi'];

                 }
   
                    else
                    {
                        //Redirect to Manage Admin PAge
                    header('location:'.SITEURl.'admin/admin.php');

                    }
                }
    ?>


<br>
<br>
        <form action="" method="post">
            <table class="tbl-add-update">
                <tr>
                    <td>İsim Soyisim: </td>
                    <td>
                        <input type="text" name="adi_soyadi" value="<?php echo $adi_soyadi;?>">
                    </td>
                </tr>
                <tr>
                    <td>KAdi: </td>
                    <td>
                        <input type="text" name="kadi"value="<?php echo $kadi;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!--id gizli olsun text yerine hiden kullandik-->
                   <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
</table>
</form>
    </div>
</div>
<?php
    //Check whether the Submit Button is clicked or not
    if(isset($_POST['submit']))
    {
    //print "button çalişiyor";

    //Get all the values from form to update
    $admin_id = $_POST['admin_id'];
    $adi_soyadi =$_POST['adi_soyadi'];
    $kadi =$_POST[ 'kadi'];
    //Create a sQL Query to Update Admin
    $sql = "UPDATE  tbl_admin SET
    adi_soyadi = '$adi_soyadi',
    kadi = '$kadi'
        WHERE admin_id='$admin_id'
        ";
                //Execute the Query
                $res=mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
        if($res==true)
            {
            //Query Executed and Admin Updated
            $_SESSION[ 'update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURl.'admin/admin.php');    
            
            }
            else
            {
    //Failed to Update Admin
    $_SESSION[ 'update'] = "<div class='eror'>failed to update admin .</div>";

    //Redirect to Manage Admin Page
    header('location:'.SITEURl.'admin/admin.php');    



    }
}

?>
<?php include('partials/footer.php');?>  


