<?php
include('partials/menu.php')
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>manage Kategori</h1><br><br>
           <?php

if(isset($_SESSION[ 'add' ])) 
{
echo $_SESSION['add']; 
unset ($_SESSION[ 'add']); 
}
if(isset($_SESSION[ 'remove' ])) 
{
echo $_SESSION['remove']; 
unset ($_SESSION[ 'remove']); 
}
if(isset($_SESSION[ 'delete' ])) 
{
echo $_SESSION['delete']; 
unset ($_SESSION[ 'delete']); 
}
if(isset($_SESSION[ 'no-kategori-found' ])) 
{
echo $_SESSION['no-kategori-found']; 
unset ($_SESSION[ 'no-kategori-found']); 
}
if(isset($_SESSION[ 'update' ])) 
{
echo $_SESSION['update']; 
unset ($_SESSION[ 'update']); 
}
if(isset($_SESSION[ 'upload' ])) 
{
echo $_SESSION['upload']; 
unset ($_SESSION[ 'upload']); 
}
if(isset($_SESSION[ 'failed-removeoad' ])) 
{
echo $_SESSION['failed-remove']; 
unset ($_SESSION[ 'failed-remove']); 
}
?>
<br><br>
               <!-- button to add user -->
    <a href="<?php  echo SITEURl; ?>admin/add-kategori.php?" class="btn-primary">Add Kategori</a>
<br>
<br>
<br>
           <table class="tbl-full">
            <tr>
            <th>S.N</th>
            <th>Sinif Adi</th>
            <th>Image</th>
            <th>Active</th>
            <th>Islem</th>
            </tr>
            
           
            <?php
            //query to get all kategori from database
            $sql = "SELECT * FROM tbl_kategori";
            //execute query 
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);
            //create serial number varibale and assing value as
            $sn=1;
            //chrck whether we have data in database or not 
            if($count>0)
            {
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $sinif_id = $row['sinif_id'];
                        $sinif_adi  = $row['sinif_adi'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];
                        
                        ?>
                                <tr>
                                     <td><?php echo $sn++?></td>
                                    <td><?php echo $sinif_adi; ?></td>
                                    <!--<td><//?php echo $image_name; ?></td>-->
                                    <td>
                                        <?php
                                        //check whether image is avalibale or not
                                        if($image_name!="")
                                        {
                                            #display the image
                                            ?>
                                            <img src="<?php echo SITEURl;?>images/kategori/<?php echo $image_name;?>" width="100px">
                                           
                                           <?php
                                        }
                                        else
                                        {
                                            //display the image
                                            echo "<div class='eror'>image not added</div>";
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $active; ?></td>
                                     <td>
                                 <a href="<?php echo SITEURl; ?>admin/update-kategori.php?sinif_id=<?php echo $sinif_id;?>" class="btn-secondary">Update kategori</a>
                                  <a href="<?php  echo SITEURl;?>admin/delete-kategori.php?sinif_id=<?php echo $sinif_id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete kategori</a>
                                     </td>
                                 </tr>
                        <?php 





                    }
            }
            else
            {
                //we do not have data
                //well display the message inside table
                ?>
                <tr>
                    <td colspan="5"><div class="eror">no kategori added.</div></td>
                </tr>
                <?php
            }
            
            
            
            
            ?>
           
           </table>
        </div>
    </div>
    <!-- Main Content Setion Ends-->
    <?php include('partials/footer.php')?>  