
<?php
include('partials/menu.php');     
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>kontrol paneli</h1><br><br>
            <?php
        if(isset($_SESSION['add']))
        {
             echo $_SESSION['add']; //Displaying Session Message
            unset($_SESSION['add']); //REmoving Session Message
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];//Displaying Session Message
            unset($_SESSION['delete']);//REmoving Session Message
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];//Displaying Session Message
            unset($_SESSION['update']);//REmoving Session Message
        }        
        if(isset($_SESSION['user-hatali']))
        {
            echo $_SESSION['user-hatali'];//Displaying Session Message
            unset($_SESSION['user-hatali']);//REmoving Session Message
        }
        if(isset($_SESSION['password-not-match']))
        {
            echo $_SESSION['password-not-match'];//Displaying Session Message
            unset($_SESSION['password-not-match']);//REmoving Session Message
        }
        if(isset($_SESSION['change-password']))
        {
            echo $_SESSION['change-password'];//Displaying Session Message
            unset($_SESSION['change-password']);//REmoving Session Message
        }
            ?>
<br><br><br>
    <!-- button to add user -->
    <a href="add-admin.php" class="btn-primary">Add User</a>
<br>
<br>
<br>
           <table class="tbl-full">
            <tr>
            <th>S.N</th>
            <th>Adi_Soyadi</th>
            <th>KAdi</th>
            <th>Islem</th>
            </tr>

            <?php
    //Query to Get all Admin
    $sql = "SELECT * FROM tbl_admin";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //CHeck whether the Query is Executed of Not
    if($res==TRUE)
    {
       // Count Rows to CHeck whether we have data in database or not
        $count = mysqli_num_rows ($res); // Function to get all the rows in database
        $sn=1; //Create a Variable and Assign the value

        //CHeck the num of rows
        if($count>0)
        {
            //WE HAve data in database
            while($rows=mysqli_fetch_assoc($res))
            {
                //using while loop to get all the data from database.
                //And while loop will run as long as we have data in database
                //Get individual DAta
                $admin_id=$rows['admin_id'];
                $adi_soyadi=$rows['adi_soyadi'];
                $kadi=$rows['kadi'];
                //Display the Values in our Table
                 ?>
                        <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $adi_soyadi;?></td>
                <td><?php echo $kadi;?></td>
                <td>
                <a href="<?php echo SITEURl; ?>admin/update-pass.php?admin_id=<?php echo $admin_id;?>" class="btn-primary">Update password</a>
                <a href="<?php echo SITEURl; ?>admin/update-admin.php?admin_id=<?php echo $admin_id;?>" class="btn-secondary">Update Admin</a>
                    <a href="<?php echo SITEURl; ?>admin/delete-admin.php?admin_id=<?php echo $admin_id?>" class="btn-danger">Delete Admin</a>
                </td>
                 <?php
            }
        }
        else
        {
            //We Do not Have Data in Database
        }
    }
    ?>









            
          
           </table>
        </div>
    </div>
    <!-- Main Content Setion Ends-->
    <?php include('partials/footer.php')?>  

