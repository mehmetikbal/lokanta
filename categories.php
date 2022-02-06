<?php include('partials-front/menu.php')?>




    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                        //query to get all kategori from database
                        $sql = "SELECT * FROM tbl_kategori WHERE active='yes'";
                        //execute query 
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            //kategori available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $sinif_id = $row['sinif_id'];
                                $sinif_adi  = $row['sinif_adi'];
                                $image_name = $row['image_name'];
                                ?>
                                 <!-- <a href="category-foods.html">-->
                                 <a href="<?php echo SITEURl;?>category-foods.php?sinif_id=<?php echo $sinif_id;?>">
                                     <div class="box-3 float-container">
                                         <?php 
                                         //check whether img is ava or not
                                         if($image_name=="")
                                         {
                                             //display message
                                             echo "<div class='eror'>image not available</div>";

                                         }
                                         else
                                         {
                                             //img ava
                                             ?>
                                                 <img src="<?php echo SITEURl;?>images/kategori/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve" >
                                             <?php 

                                         }
                                         
                                         ?>
                                             <h3 class="float-text text-white"><?php echo $sinif_adi; ?></h3>
                                     </div>
                                     </a>

                                <?php 
                            }  
                        }
                        else
                        {
                            //kategori not ava
                            echo "<div class='eror'>kategori not added</div>";
                        }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php')?>