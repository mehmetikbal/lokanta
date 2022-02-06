<?php include('partials/menu.php');
//echo "update food"; bottun kontrolu?>
<?php
//check whether id is set or not
if(isset($_GET['y_id']))
{
    //get all the details
    $y_id = $_GET['y_id'];
    //sql query to get the selected foof
    $sql2 = "SELECT * FROM tbl_yemek WHERE y_id=$y_id";
    //execute the query 
    $res2 = mysqli_query($conn, $sql2);
    //get the value based on query execute d
    $row2 = mysqli_fetch_assoc($res2);
    //get the invdividual value of selected food
                $yemek_adi = $row2 ['yemek_adi'];
                $acıklama = $row2 ['acıklama'];
                $fiyatı = $row2 ['fiyatı'];
                $current_image = $row2 ['image_name'];
                $kategori = $row2 ['sinif_id'];
                $active = $row2 ['active'];

}
else
{
    //redirect to manage food
    header("location:".SITEURl.'admin/yemek.php');

}





?>
<div class="main-content">
    <div class="wrapper">
        <h1>update food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-add-update">
                <tr>
                    <td>yemek adi</td>
                    <td>
                        <input type="text" name="yemek_adi" value="<?php echo $yemek_adi;?>">
                    </td>
                </tr>
                <tr>
                    <td>aicklama</td>
                    <td>
                        <textarea name="acıklama"  cols="30" rows="5" ><?php echo $acıklama;?></textarea>
                    </td>
                    
                </tr>
                <tr>
                    <td>current imag</td>
                    <td>
                    <?php 
                        if($current_image != "")
                        {
                            //image not available
                            ?>
                            <img src="<?php echo SITEURl; ?>images\food\<?php echo $current_image;?>" width="100px" >
                            <?php
                        }
                        else
                        {
                            //display message 
                            echo "<div class='eror'>image not available</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td> new select img </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>fiyat</td>
                    <td>
                        <input type="number" name="fiyatı" value="<?php echo $fiyatı; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>kategori</td>
                    <td>
                        
                        <select name="kategori" value="0">
                            
                            <?php 
                        //query to het active kategori
                        $sql = "SELECT * FROM tbl_kategori WHERE active='yes'";
                        //execute the query 
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count = mysqli_num_rows($res);
                        //check whether kategori available or not
                        if($count>0)
                        {
                            //kategori available
                                while($row=mysqli_fetch_assoc($res))
                                
                                {
                                    $sinif_id = $row['sinif_id'];
                                    $sinif_adi = $row['sinif_adi'];
                                    //echo "<option value='$sinif_id'>$sinif_adi</option>";
                                    ?>
                                    <option <?php if($kategori==$sinif_id){echo "selected";}?> value="<?php echo $sinif_id;?>"><?php echo $sinif_adi; ?></option>
                                    <?php
                                }
                        }
                        else
                        {
                            //kategori not available
                            echo "<option value='0'>kategori not available</option>";
                        }
                        
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>active</td>
                    <td>
                    <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes"> yes 
                    <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no"> no


                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>" >
                <input type="hidden" name="y_id" value="<?php echo $y_id;?>" >
                <input type="submit" name="submit" value="update yemek" class="btn-secondary">
                </td>
            </tr>

            </table>
        </form>
        <?php 
                if(isset($_POST['submit']))
                {
                //echo "button clicked";
                    //1. Get all the details from the form
                    $yemek_id = $_POST ['y_id'];
                    $yemek_adi = $_POST ['yemek_adi'];
                    $acıklama = $_POST ['acıklama'];
                    $fiyatı = $_POST ['fiyatı'];
                    $current_image = $_POST ['current_image'];
                    $kategori = $_POST ['kategori'];
                    $active = $_POST ['active'];
                    //2. Upload the image if selected
                    //CHeck whether upload button is clicked or not
                        if(isset($_FILES['image']['name']))
                        {
                            //upload button clicked 
                            $image_name = $_FILES['image']['name']; //new img
                            //check whether the file is available or not
                            if($image_name != "")
                            {
                                //img is available
                                //get the source path and destination path
                                $src_path=$_FILES['image']['tmp_name'];//source path
                                $dest_path="../images/food/".$image_name;
                                    //finally upload image
                                 $upload = move_uploaded_file($src_path , $dest_path);
                                    //check whether the image is uploaded or not

                                    if($upload==false)
                                    {
                                        //set  message
                                        $_SESSION['upload'] = "<div class='eror'>failed to upload image.</div>";
                                        //redirect to add kategori page
                                        header("location:".SITEURl.'admin/yemek.php');
                                        //stop the process
                                        die();
                                        
                    
                                    }
                                     //3. Remove the image if new image is uploaded and current image exists
                                      //b.remove the current img if available
                                         if($current_image!="")
                                            {
                                                //cirrent img is availeble
                                                //remove the img
                                            $remove_path = "../images/food/".$current_image;
                                             $remove = unlink($remove_path);
    
                                            //check whether the img is removed or not
                                             
                                            if($remove==false)
                                                {
                                                    //failed to romove current img
                                                    $_SESSION['failed-remove'] = "<div class='eror'>failed to remove current img.</div>";
                                                    //redirect to manage food
                                                    header("location:".SITEURl.'admin/yemek.php');
                                                    die(); //stop procees
                                                } 
                                             }
                            }
                            else
                            {
                                $image_name = $current_image;//Default Image when Image is Not Selected

                            }

                        }
                        else
                        {
                            $image_name = $current_image;//Default Image when Button is not Clicked

                        }
                    //4. Update the Food in Database

                    $sql3 = "UPDATE tbl_yemek SET 
                    yemek_adi = '$yemek_adi',
                    acıklama = '$acıklama',
                    fiyatı = $fiyatı,
                    image_name = '$image_name',
                    sinif_id = '$kategori',
                    active = '$active'
                    WHERE y_id=$yemek_id
                    ";
                     //execute the query 
                $res3 = mysqli_query($conn, $sql3);
                //chwck whether data inserted or not
                
                if($res3==true)
                {
                    //query executed and food updated
                    $_SESSION['update'] = "<div class='success'>food updated successfly. </div>";
                    //redirect to manage kategori page 
                    header("location:".SITEURl.'admin/yemek.php');
                }
                else
                 {
                    //failed to updated food
                 $_SESSION['update'] = "<div class='eror'>Failed to update food</div>";
                    //Redirect Page to add Admin
                     header("location:".SITEURl.'admin/yemek.php');
    
                 }
                }
        ?>
    </div>
</div>









<?php include('partials/footer.php');?>