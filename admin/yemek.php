<?php
include('partials/menu.php')
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>manage yemek</h1><br><br>
               <!-- button to add user -->
    <a href="<?php  echo SITEURl; ?>admin/add-yemek.php?"  class="btn-primary">Add yemek</a>
<br>
<br>
<br>
                <?php 
                if(isset($_SESSION[ 'add' ])) 
                {
                echo $_SESSION['add']; 
                unset ($_SESSION[ 'add']); 
                }
                if(isset($_SESSION[ 'delete' ])) 
                {
                echo $_SESSION['delete']; 
                unset ($_SESSION[ 'delete']); 
                }
                if(isset($_SESSION[ 'upload' ])) 
                {
                echo $_SESSION['upload']; 
                unset ($_SESSION[ 'upload']); 
                }
                if(isset($_SESSION[ 'unauthorized' ])) 
                {
                echo $_SESSION['unauthorized']; 
                unset ($_SESSION[ 'unauthorized']); 
                }
                if(isset($_SESSION[ 'update' ])) 
                {
                echo $_SESSION['update']; 
                unset ($_SESSION[ 'update']); 
                }

                ?>
           <table class="tbl-full">
            <tr>
            <th>S.N</th>
            <th>yemek adi</th>
            <th>aciklama</th>
            <th>imag</th>
            <th>fiyat</th>
            <th>active</th>
            <th>islem</th>


            </tr>
            <?php
            //craete a sql query to get all the food
            $sql = "SELECT * FROM tbl_yemek";
            //execute the query 
            $res = mysqli_query($conn , $sql);
            //count rows to check whether we haVE FOOD OR NOT
            $count = mysqli_num_rows($res);
            //create serial num varible and set default value as 1
            $sn=1;
            if($count>0)
            {
                //we have food in database
                //get the foods from database and display
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values from individual columus
                    $y_id = $row['y_id'];
                    $yemek_adi  = $row['yemek_adi'];
                    $acıklama = $row['acıklama'];
                    $image_name = $row['image_name'];
                    $fiyatı= $row['fiyatı'];
                    $active = $row['active'];
                    ?>
          <tr>
                <td><?php echo $sn++;?></td>
                <td><?php echo $yemek_adi;?></td>
                <td><?php echo $acıklama;?></td>
                <!--<td><//?php echo $image_name;?></td>-->
                <td>
                    <?php 
                    //check whether we have img or not 
                    if($image_name=="")
                    {
                        //we do not have img , display eror message 
                        echo "<div class='eror'>image not added.</div>";
                    }
                    else
                    {
                        //we have img , display img
                        ?>
                        <img src="<?php echo SITEURl;?>images/food/<?php echo $image_name;?>" width="100px">
                       
                       <?php
                    }
                    
                    
                    
                    
                    ?>
                </td>
                <td><?php echo $fiyatı;?>.TR</td>
                <td><?php echo $active;?></td>

                <td>
                <a href="<?php  echo SITEURl;?>admin/update-food.php?y_id=<?php echo $y_id;?>" class="btn-secondary">Update yemek</a>
                    <a href="<?php  echo SITEURl;?>admin/delete-food.php?y_id=<?php echo $y_id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete yemek</a>
                </td>

            </tr>



                   <?php
                }
            }
            else
            {
                //food not added in database 
                echo "<tr><td colspan='6' class='ero'>food not added yet.</td></tr>";
            }
            ?>
           </table>
        </div>
    </div>
    <!-- Main Content Setion Ends-->
    <?php include('partials/footer.php')?>  