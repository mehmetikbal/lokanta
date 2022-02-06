<?php
include('partials/menu.php')
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>
        <br><br>
        <?php
            //check wether id is set or not
            if(isset($_GET['o_id']))
            {
                //get the order deta;lis
                $o_id=$_GET['o_id'];
                //get all other detalis based or this id 
                //sql query to get the oder detalis
                $sql = "SELECT * FROM tbl_order WHERE o_id=$o_id";
                //execute query 
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //detali ava
                 
                    $row=mysqli_fetch_assoc($res);
                    

                    $food=$row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //not ava
                    //redirect to order page
                    header("location:".SITEURl.'admin/order.php');

                }

            }
            /*else
            {
                //redirect to order page
              //   header("location:".SITEURl.'admin/order.php');
            }*/
        
        ?>
        <form action="" method="POST">
            <table class="tbl-add-update">
                <tr>
                    <td>food name</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td> price</td>
                    <td><?php echo $price;?> <b>tl</b></td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity;?>">
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="ordered"){echo "selected";}?> value="orderd">orderd</option>
                            <option <?php if($status=="on delivery"){echo "selected";}?> value="on delivery">on delivery</option>
                            <option <?php if($status=="delivered"){echo "selected";}?> value="delivered">delivered</option>
                            <option <?php if($status=="cancelled"){echo "selected";}?> value="cancelled">cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                    <tr>
                    <td>customer_contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>  
                              <tr>
                    <td>customer_address:</td>
                    <td>
                        <textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td colspan='2'>
                    <input type="hidden" name="o_id" value="<?php echo $o_id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <input type="submit" name="submit" value="Update order" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        //check whether update button is clicked or not 
        if(isset($_POST['submit']))
        {
           // echo "clicked";
                           //get all the detalis from the form 
                           $food = $_POST['food'];
                           $price = $_POST['price'];
                           $quantity = $_POST['quantity'];
                           $total = $fiyatı * $quantity; // total = price*qty
                           
                           $status = $_POST['status'];
                           $customer_name = $_POST['customer_name'];
                           $customer_contact = $_POST['customer_contact'];
                           $customer_address = $_POST['customer_address'];
                           //update the values
                           $sql2= "UPDATE tbl_order SET
                           quantity = $quantity,
                           total = $total,
                           status = '$status',
                           customer_name = '$customer_name',
                           customer_contact = '$customer_contact',
                           customer_address = '$customer_address'
                           WHERE o_id=$o_id
                           " ;
                           //execute the query 
                           $res2 = mysqli_query($conn, $sql2);
                           //check whether update or not
                           //and redirect to manage order with message
                           if($res2==true)
                {
                    //query executed and order saved 
                    $_SESSION['update'] = "<div class='success text-center'> order update successfully</div>";
                    header("location:".SITEURl.'admin/order.php');


                }
                else
                {
                    //failed to save order 
                    $_SESSION['order'] = "<div class='eror '>failed to update order </div>";
                    header("location:".SITEURl.'admin/order.php');



                }
        }
        
        ?>
    </div>
</div>





































<?php include('partials/footer.php')?> 