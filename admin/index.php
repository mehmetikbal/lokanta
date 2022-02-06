

<?php
include('partials/menu.php')

?>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>kontrol paneli</h1><br><br>
           <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];//Displaying Session Message
            unset($_SESSION['login']);//REmoving Session Message
        } 
        
        ?>
        <br><br>
           <div class="col-4 text-center">
               <?php 
               #sql query 
               $sql= "SELECT * FROM tbl_kategori";
               #execute query 
               $res = mysqli_query($conn, $sql);
               //count rows
               $count = mysqli_num_rows($res);
               
               ?>
               <h1><?php echo $count;?></h1>
               <br>
               Kategori
           </div>
         
       
           <div class="col-4 text-center">
           <?php 
               #sql query 
               $sql2= "SELECT * FROM tbl_yemek";
               #execute query 
               $res2 = mysqli_query($conn, $sql2);
               //count rows
               $count2 = mysqli_num_rows($res2);
               
               ?>
               <h1><?php echo $count2;?></h1>
               <br>
               Food
           </div>
           <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Setion Ends-->
<?php include('partials/footer.php')?>


