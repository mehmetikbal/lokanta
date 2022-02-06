<?php include('partials/menu.php');
//echo "update katrgori"; bottun kontrolu
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Kategori</h1>
        <br><br>
        <?php 
        //check whether the sinif_id is set or  net 
        if(isset($_GET['sinif_id']))
        {
            //get the sinif_id and all other detalis 
            //echo "getting the data";
            $sinif_id = $_GET['sinif_id'];
            //create sql query to get all other detalis 
            $sql = "SELECT * FROM tbl_kategori WHERE sinif_id=$sinif_id ";

            //EXECUTE THE QUERY 
            $res= mysqli_query($conn, $sql);

            //count the rows to check whetherthe sinif_adi is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data 
                $row = mysqli_fetch_assoc($res);
                        $sinif_adi  = $row['sinif_adi'];
                        $current_image  = $row['image_name'];
                        $active = $row['active'];
            }
            else
            {
                //redirect to manage kategori with session message
                $_SESSION['no-kategori-found'] = "<div class='eror'>kategori not found</div>";
                header("location:".SITEURl.'admin/kategori.php');

            }



        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-add-update">
                <tr>
                    <td>
                        Sinif Adi
                    </td>
                    <td>
                        <input type="text" name="sinif_adi" value="<?php echo $sinif_adi;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image : </td>
                    <td>
                        <?php 
                        if($current_image != "")
                        {
                            //display the image 
                            ?>
                            <img src="<?php echo SITEURl; ?>images\kategori\<?php echo $current_image;?>" width="100px" >
                            <?php
                        }
                        else
                        {
                            //display message 
                            echo "<div class='eror'>image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>active : </td>
                    <td>
                    <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes"> yes 
                    <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no"> no
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>" >
                <input type="hidden" name="sinif_id" value="<?php echo $sinif_id;?>" >
                <input type="submit" name="submit" value="Update Kategori" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            #1. get all the values from our from 
            $sinif_id = $_POST['sinif_id'];
            $sinif_adi = $_POST['sinif_adi'];
            $current_image = $_POST['current_image'];
            $active = $_POST['active'];

            #2.updating new img if selected 
            //check whether the img is selected or not
            if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];
                    //check whether the img is seleckted or not
                    if($image_name != "")
                    {
                        //img available
                        //a.upload the new img

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/kategori/".$image_name;
                        //finally upload image
                        $upload = move_uploaded_file($source_path , $destination_path);
        
                        //check whether the image is uploaded or not
                        //and if the image is not uoloaded then we will stop the process and redirect with eror message
                        if($upload==false)
                        {
                            //set  message
                            $_SESSION['upload'] = "<div class='eror'>failed to upload image.</div>";
                            //redirect to add kategori page
                            header("location:".SITEURl.'admin/kategori.php');
                            //stop the process
                            die();
                            
        
                        }

                        //b.remove the current img if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/kategori/".$current_image;
                            $remove = unlink($remove_path);
    
                            //check whether the img is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove==false)
                            {
                                //failed to romove img
                                $_SESSION['failed-remove'] = "<div class='eror'>failed to remove current img.</div>";
                                header("location:".SITEURl.'admin/kategori.php');
                                die(); //stop procees
                            } 
                        }

                    }
                            else
                                {
                                    $image_name = $current_image;
                                }
                    
                }
            #3. update the database
            $sql2 = "UPDATE tbl_kategori SET 
            sinif_adi = '$sinif_adi',
            image_name = '$image_name',
            active = '$active'
             WHERE sinif_id=$sinif_id";

             //execute the query 
             $res2 = mysqli_query($conn , $sql2);

             //4. redirect to manage kategori with message 
             //check whether execute or not
                if($res2==true)
                {
                    //kategori updated
                    $_SESSION['update'] = "<div class='success'>kategori updated successfly.</div>";
                header("location:".SITEURl.'admin/kategori.php');

                }
                else
                {
                    //failed to update kategori
                    $_SESSION['update'] = "<div class='eror'>failed to updated kategori .</div>";
                header("location:".SITEURl.'admin/kategori.php');



                }




        }
        
        
        
        ?>
    </div>
</div>







<?php include('partials/footer.php');?>