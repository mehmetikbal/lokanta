<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add kategori</h1>
        <br><br>
        <?php

            if(isset($_SESSION[ 'add' ])) 
            {
            echo $_SESSION['add']; 
            unset ($_SESSION[ 'add']); 
            }
            if(isset($_SESSION[ 'upload' ])) 
            {
            echo $_SESSION['upload']; 
            unset ($_SESSION[ 'upload']); 
            }
            ?>
        <!--add kategori form start -->
        <form action="" method="POST" enctype="multipart/form-data" >
            <table class="tbl-add-update">
                <tr>
                    <td>sinif adi:</td>
                    <td>
                        <input type="text" name="sinif_adi" placeholder="kategori adi">
                    </td>
                </tr>
                <tr>
                    <td>select image :</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>active : </td>
                    <td>
                        <input type="radio" name="active" value="yes"> yes 
                    <input type="radio" name="active" value="no"> no
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                <input type="submit" name="submit" value="Add kategori" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
        <!--add kategori form ends -->
        <?php 
        #checd whether the submit button is clicked or not

        if(isset($_POST['submit']))
        {
            #echo "clicked";
            #1. get the value from kategori form 
            $sinif_adi=$_POST['sinif_adi'];

            #for radio input, we need to check whether the button is selected or not
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "no";
            }
            //check whether the image is seleceted or not and set the value for image name accoridingly
            //print_r($_FILES['image']);
            //die();//break the code here

            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name ,source path and destination path
                $image_name=$_FILES['image']['name'];
                
                //upload to img only if img is seeckted
                if($image_name !="")
                {

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
                    header("location:".SITEURl.'admin/add-kategori.php');
                    //stop the process
                    die();
                    

                }
            }
            }
            else
            {
                //dont upload image and set the image_name value as blank  
                $image_name="";
            }



            #2.create sql query to insert kategori into database
            $sql = "INSERT INTO tbl_kategori  SET 
            sinif_adi='$sinif_adi',
            image_name='$image_name',
            active='$active'
            ";
            #3. EXECUTE THE QUERY AND SAVE IN DATABASE
            $res=mysqli_query($conn, $sql);


            #4.check whether the qury executed or not and data added or not
            if($res==true)
            {
                //query exected and kategori added
                $_SESSION['add'] = "<div class='success'>kategori added successfly. </div>";
                //redirect to manage kategori page 
                header("location:".SITEURl.'admin/kategori.php');
            }
            else
            {
                //create  to add kategori
        $_SESSION['add'] = "<div class='eror'>Failed to Add kategori</div>";
        //Redirect Page to add Admin
        header("location:".SITEURl.'admin/add-kategori.php');

            }






        }
        
        
        
        
        
        
        
        
        
        
        
        
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>