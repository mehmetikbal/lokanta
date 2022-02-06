<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>add food</h1>
        <br><br>
        <?php
        if(isset($_SESSION[ 'upload' ])) 
        {
        echo $_SESSION['upload']; 
        unset ($_SESSION[ 'upload']); 
        }
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data" >
            <table class="tbl-add-update">
                <tr>
                    <td>yemek adi: </td>
                    <td>
                        <input type="text" name="yemek_adi" placeholder="yemek adi">
                    </td>
                </tr>
                <tr>
                    <td>aciklama</td>
                    <td>
                        <textarea name="acıklama"  cols="30" rows="5" placeholder="yemek tarifi"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>selecet img</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>fiyat</td>
                    <td>
                        <input type="number" name="fiyatı" >
                    </td>
                </tr>
                <tr>
                    <td>kategori</td>
                    <td>
                        <select name="kategori" >
                            <?php 
                            //create php code to display kategori from database 
                            //1. create sql to get all active kategori from database 
                            $sql = "SELECT * FROM  tbl_kategori WHERE active='yes'";
                            //execute query 
                            $res = mysqli_query($conn ,$sql);
                            //count rows to check whether we have kategori or not
                            $count = mysqli_num_rows($res);
                            //if count is greater than zero ,we have kategori else we dont have kategori
                            if($count>0)
                            {
                                //we have kategori 
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of kategori
                                        $sinif_id = $row['sinif_id'];
                                        $sinif_adi = $row['sinif_adi'];

                                        ?>
                                        <option value="<?php echo $sinif_id;?>"><?php echo $sinif_adi;?></option>
                                        <?php

                                    }

                            }
                            else
                            {
                                //we do not have kategori
                                ?>
                                <option value="0">no kategori food</option>
                                <?php

                            }
                            
                            
                            ?>
                            
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>activ</td>
                    <td>
                    <input type="radio" name="active" value="yes">yes
                    <input type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <input type="submit" name="submit" value="Add yemek" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>

        <?php
                //CHeck whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                //Add the Food in Database
                //echo "Clicked";
                //1. Get the DAta from Form
                $yemek_adi = $_POST ['yemek_adi'];
                $acıklama = $_POST ['acıklama'];
                $fiyatı = $_POST ['fiyatı'];
                $kategori = $_POST ['kategori'];

                //check whether radion button for active are checked or not
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "no"; //setting default vale
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

                $destination_path="../images/food/".$image_name;
                //finally upload image
                $upload = move_uploaded_file($source_path , $destination_path);

                //check whether the image is uploaded or not
                //and if the image is not uoloaded then we will stop the process and redirect with eror message
                if($upload==false)
                {
                    //set  message
                    $_SESSION['upload'] = "<div class='eror'>failed to upload image.</div>";
                    //redirect to add kategori page
                    header("location:".SITEURl.'admin/add-yemek.php');
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

                //3. Insert Into Database
                //create a sql query to save or add food
                $sql2 = "INSERT INTO tbl_yemek SET 
                yemek_adi = '$yemek_adi',
                acıklama = '$acıklama',
                fiyatı = $fiyatı,
                image_name = '$image_name',
                sinif_id = '$kategori',
                active = '$active'
                ";
                //execute the query 
                $res2 = mysqli_query($conn, $sql2);
                //chwck whether data inserted or not
                //4. Redirect with MESsage to Manage Food page
                if($res2==true)
                {
                    //data inserted successfuly
                    $_SESSION['add'] = "<div class='success'>food added successfly. </div>";
                    //redirect to manage kategori page 
                    header("location:".SITEURl.'admin/yemek.php');
                }
                else
                {
                    //failed to insert data
            $_SESSION['add'] = "<div class='eror'>Failed to Add food</div>";
            //Redirect Page to add Admin
            header("location:".SITEURl.'admin/yemek.php');
    
                }
                
                }
            ?>
    </div>
</div>
<?php include('partials/footer.php')?>