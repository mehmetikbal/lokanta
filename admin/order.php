<?php
include('partials/menu.php')
?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>manage order</h1><br><br>
           <?php 
                if(isset($_SESSION[ 'update' ])) 
                {
                echo $_SESSION['update']; 
                unset ($_SESSION[ 'update']); 
                }
                ?>

           <table class="tbl-full">
            <tr>
            <th>S.N</th>
            <th>food</th>
            <th>price</th>
            <th>quantity</th>
            <th>total</th>
            <th>order_date</th>
            <th>status</th>
            <th>customer_name</th>
            <th>customer_contact</th>
            <th>customer_address</th>
            <th>Islem</th>
            </tr> 
            <?php
            
            //get all the order from database
            $sql = "SELECT * FROM  tbl_order ORDER BY o_id DESC";
            //execute query 
            $res = mysqli_query($conn, $sql);
            //count the rows 
            $count = mysqli_num_rows($res);
            $sn = 1; //create a serial number and its value as 1
            if($count>0)
            {
                //order ava
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all order details
                    $o_id = $row['o_id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $total = $row ['total'] ;
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                    ?>
                     <tr>
                <td><?php echo $sn++;?>.</td>
                <td><?php echo $food;?></td>
                <td><?php echo $price;?> <b>tl</b></td>
                <td><?php echo $quantity;?></td>
                <td><?php echo $total;?> <b>tl</b></td>
                <td><?php echo $order_date;?></td>
                <td><?php echo $status;?></td>
                <td><?php echo $customer_name;?></td>
                <td><?php echo $customer_contact;?></td>
                <td><?php echo $customer_address;?></td>
                <td>
               <a href="<?php echo SITEURl; ?>admin/update-orderr.php?o-id=<?php echo $o_id;?>" class="btn-secondary">Update order</a>
                </td>
             </tr>
             <?php  

                }
            }
            else
            {
                //order not ava
                echo "<tr><td colspan='12' class='eror'>order not available</td></tr>";
                
            }
            
            
            ?>
            
            
           
           
           </table>
        </div>
    </div>
    <!-- Main Content Setion Ends-->
    <?php include('partials/footer.php')?>  