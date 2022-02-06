
<?php include('partials-front/menu.php');?>
<?php
#check wether food id is set or not
if(isset($_GET['y_id']))
{
    #get the food id and details of the selected food
    $y_id = $_GET['y_id'];
    //get the details of the selected food
    $sql = "SELECT * FROM tbl_yemek WHERE y_id=$y_id";
    //execute the query 
    $res = mysqli_query($conn, $sql);
    //count the rows
    $count = mysqli_num_rows($res);
    //check wether the data is ava or not 
    if($count==1)
    {
        //we have data 
        //get the data from database 
        $row = mysqli_fetch_assoc($res);
        $yemek_adi  = $row['yemek_adi'];
        $fiyatı= $row['fiyatı'];
        $image_name = $row['image_name'];
    }
    else 
    {
        //food not ava
        //redirct to home page
        header("location:".SITEURl);
    }
}
else
{
    //redirect to home page
    header("location:".SITEURl);
}


?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    <?php 
                                         //check whether img is ava or not
                                         if($image_name=="")
                                         {
                                             //img not ava
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
                        <h3><?php echo $yemek_adi ;?></h3>
                        <input type="hidden" name="yemek_adi" value="<?php echo $yemek_adi;?>">
                        <p class="food-price">$<?php echo $fiyatı; ?></p>
                        <input type="hidden" name="fiyatı" value="<?php echo $fiyatı;?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" required>
                        
                    </div>
                </fieldset>
               
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder=" ornek: mehmet ikbal " class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="ornek: 05315984264" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder=" Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            //check wether submit buton is clicked or not 
            if(isset($_POST['submit']))
            {
                //get all the detalis from the form 
                $food = $_POST['food'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $fiyatı * $quantity; // total = price*qty
                $order_date = date ("y-m-d h:i:sa");//order date
                $status = "ordered";//orderd ondelivery delivered cancelled
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_address = $_POST['address'];



                //save the order in database 
                //create sql to save the data
                $sql2 = "INSERT INTO tbl_order SET
                food = '$yemek_adi',
                price = '$fiyatı',
                quantity = '$quantity',
                total = '$total',
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_address = '$customer_address'
                ";
                //execute the query 
                $res2 = mysqli_query($conn, $sql2);
                //check whether query executed succ or not 
                if($res2==true)
                {
                    //query executed and order saved 
                    $_SESSION['order'] = "<div class='success text-center'>food ordered successfully</div>";
                     header("location:".SITEURl);

                }
                else
                {
                    //failed to save order 
                    $_SESSION['order'] = "<div class='eror text-center'>failed to order food</div>";
                     header("location:".SITEURl);


                }

            }
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partials-front/footer.php');?>