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

                    $food = $row['food'];
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
            else
            {
                //redirect to order page
              //   header("location:".SITEURl.'admin/order.php');
            }
        
        ?>



        <form action="" method="POST">
            <table class="tbl-add-update">
                <tr>
                    <td>food name</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td> price</td>
                    <td><?php echo $price;?></td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td>
                        <input type="number" name="quantity" value="">
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status" >
                            <option value="orderd">orderd</option>
                            <option value="on delivery">on delivery</option>
                            <option value="delivered">delivered</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="customer_name" value="">
                    </td>
                    <tr>
                    <td>customer_contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="">
                    </td>
                </tr>                <tr>
                    <td>customer_address:</td>
                    <td>
                        <textarea name="customer_address"  cols="30" rows="5"></textarea>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td colspan='2'>
                    <input type="submit" name="submit" value="Update order" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>





<?php include('partials/footer.php')?> 