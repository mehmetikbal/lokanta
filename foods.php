<?php include('partials-front/menu.php')?>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                        //geting foods from database that are active
                        //sql qery
                        $sql = "SELECT * FROM tbl_yemek WHERE active='yes' ";
                        
                        //execute the query 
                        $res = mysqli_query($conn , $sql);
                        //count rows 
                        $count = mysqli_num_rows($res);
                        //check whether food ava or not
                        if($count>0)
                        {
                            //food  ava
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get all the values
                                $y_id = $row['y_id'];
                                $yemek_adi  = $row['yemek_adi'];
                                $acıklama = $row['acıklama'];
                                $image_name = $row['image_name'];
                                $fiyatı= $row['fiyatı'];
                                ?>
                                   <div class="food-menu-box">
                                     <div class="food-menu-img">
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
                                                 <img src="<?php echo SITEURl;?>images/food/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve" >
                                             <?php 

                                         }
                                         
                                         ?>
                                     
                                     </div>

                                      <div class="food-menu-desc">
                                             <h4><?php echo $yemek_adi ;?></h4>
                                             <p class="food-price">$<?php echo $fiyatı; ?></p>
                                            <p class="food-detail">
                                             <?php echo $acıklama  ;?>
                                              </p>
                                            <br>
                                            <a href="<?php echo SITEURl;?>mycart.php?y_id=<?php echo $y_id ?>" class="btn btn-primary">order now </a>
                                            <br>
                                            <br>
                                            <a href="<?php echo SITEURl;?>mycart.php?y_id=<?php echo $y_id ?>" class="btn btn-primary">Add To Cart </a>
                                     </div>
                              </div>
                                <?php 
                            }
                        }
                        else
                        {
                            //food not ava
                            echo "<div class='eror'>food not available</div>";


                        }
            ?>
            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php')?>
