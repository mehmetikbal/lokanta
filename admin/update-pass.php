<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>change password</h1>
        <br>
        <?php 
        if(isset($_GET['admin_id']))
        {
            $admin_id=$_GET['admin_id'];
        }
        
        ?>
        <form action="" method="POST">
        <table class="tbl-add-update">
            <tr>
                <td>  current password</td>
                <td>
                    <input type="password" name="current_password" placeholder="current password">
                </td>
            </tr>
            <tr>
                <td>new password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="new password">
                </td>
            </tr>
            <tr>
                <td>confirm password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="confirm password ">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                
                   <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

                    <input type="submit" name="submit" value="change password" class="btn-secondary">
                </td>
            </tr>
</table>
        </form>
    </div>
</div>
<?php 
            //check the submit button   
            if(isset($_POST['submit']))
            {
               // echo "clicked";
               //1.get the data from form
            $admin_id=$_POST['admin_id'];
            $current_password=md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);
                //2.check whether the user with cruuent admin_id and current pass exists or not 
            
            $sql="SELECT * FROM  tbl_admin WHERE admin_id='$admin_id' AND  sifre='$current_password'"; 

            //execute the query 
            $res = mysqli_query($conn, $sql);

            if($res==true)
                {  
                    #check whether data is availabl or not
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        //user exists and pass can be change
                        //echo "user hatali";

                            //checd whether th new pass and confirm match or not
                            if($new_password==$confirm_password)
                            {
                                //update the pass
                              // echo "password match";
                              $sql2 = "UPDATE tbl_admin SET 
                              sifre='$new_password' 
                              WHERE admin_id=$admin_id  ";
                              #execute the query
                              $res2 = mysqli_query($conn, $sql2);
                              #check whether the qury exeuted or no 
                              if($res2==true)
                              {
                                  #display succes mesage
                                //redirect to mange admin page with success message

                                  $_SESSION['change-password']="<div class='success'>password change successfully.</div>";
                                  #redirect the user
                               
                                    header('location:'.SITEURl.'admin/admin.php');
                              }
                              else
                              {
                                  #display eror mesage
                                //redirect to mange admin page with ereor message

                                  $_SESSION['change-password']="<div class='eror'>failed to change password .</div>";
                                  #redirect the user
                               
                                    header('location:'.SITEURl.'admin/admin.php');
                              }
                                

                            }
                            else
                            {
                                //redirect to mange admin page with ereor message
                                $_SESSION['password-not-match']="<div class='eror'>password not match.</div>";
                                #redirect the user
                             
                                  header('location:'.SITEURl.'admin/admin.php');

                            }
                    }
                        else
                        {
                        //user does not exists set message and redirect
                       $_SESSION['user-hatali']="<div class='eror'>user hatali.</div>";
                        #redirect the user
                        header('location:'.SITEURl.'admin/admin.php');

                        }

                }
            }
        


?>
<?php include('partials/footer.php');?>
