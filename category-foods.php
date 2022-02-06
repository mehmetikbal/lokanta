<?php include('partials-front/menu.php')?>
<?php
//check  whether id is passed or not 
if(isset($_GET['sinif_id']))
{
//kategori id is set and get the id 
$sinif_id = $_GET['sinif_id'];
//get the kategori sinif adi based on kategori sinif id
$sql = "SELECT sinif_adi FROM tbl_kategori WHERE sinif_id=$sinif_id ";
//execute the query
$res = mysqli_query($conn, $sql);
//get the value from database 
$row = mysqli_fetch_assoc($res);
//get the sinif adi 
$sinif_adi  = $row['sinif_adi'];
}
else
{
    //kategori not passed
    //redirect to home page
    header("location:".SITEURl);

}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white">"<?php echo $sinif_adi;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //create sql query to get founds based on selected kategori 
$sql2 = "SELECT * FROM tbl_yemek WHERE sinif_id=$sinif_id AND  active='yes' ";
//execute the query 
$res2 = mysqli_query($conn, $sql2);
//count the rows
$count2 = mysqli_num_rows($res2);
//check whether food is ava or not 
if($count2>0)
{
    //food is ava 
    while($row2=mysqli_fetch_assoc($res2))
    {
        $y_id=$row2 ['y_id'];
        $yemek_adi = $row2 ['yemek_adi'];
        $acıklama = $row2 ['acıklama'];
        $fiyatı = $row2 ['fiyatı'];
        $image_name = $row2 ['image_name'];
        ?>
         <div class="food-menu-box">
                <div class="food-menu-img">
                <?php 
                                         // img is ava or not
                                         if($image_name=="")
                                         {
                                             //display message
                                             echo "<div class='eror'>image not available</div>";

                                         }
                                         else
                                         {
                                             //img ava
                                             ?>
                                                 <img src="<?php echo SITEURl;?>images/food/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                             <?php 

                                         }
                                         
                                         ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $yemek_adi;?></h4>
                    <p class="food-price">$<?php echo $fiyatı;?></p>
                    <p class="food-detail">
                       <?php echo $acıklama;?>
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
    