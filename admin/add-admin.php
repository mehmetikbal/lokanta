<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>
        <?php

        if(isset($_SESSION[ 'add' ])) //Checking whether the SESsion is Set of Not
        {
        echo $_SESSION['add']; //Display the SESsion Message if SEt
        unset ($_SESSION[ 'add']); //Remove Session Message
        }
?>
        <form action="" method="post">
            <table class="tbl-add">
                <tr>
                    <td>İsim Soyisim: </td>
                    <td>
                        <input type="text" name="adi_soyadi" placeholder="İsminiz Girin">
                    </td>
                </tr>
                <tr>
                    <td>KAdi: </td>
                    <td>
                        <input type="text" name="kadi" placeholder="KAdi Girin">
                    </td>
                </tr>
                <tr>
                    <td>Şifre: </td>
                    <td>
                        <input type="password" name="sifre" placeholder="Şifreniz Girin">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php')?>






<?php
    //Process the Value from Form and Save it in Database
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // Button kontrolu clicked
        //echo "Button Clicked";

        //1.Get the Data from form;
         $adi_soyadi = $_POST['adi_soyadi'];
         $kadi = $_POST['kadi'];
         $sifre =md5($_POST['sifre']); //md5 sifre gizle
         //2.sql query to save the data into database
         $sql = "INSERT INTO  tbl_admin  SET 
         adi_soyadi='$adi_soyadi',
         kadi='$kadi', 
         sifre='$sifre'";

            //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

       //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
if($res==TRUE)
{
    //Data Inserted
    //echo "Data Inserted";
    //create a Session Variable to Display Message
             $_SESSION[ 'add'] = "<div class='success'>Admin Added Successfully.</div>";
        //Redirect Page to Manage Admin
        header("location:".SITEURl.'admin/admin.php');

}
else
{
    //FAiled to Insert DAta
    //echo "Faile to Insert Data";
        //create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='eror'>Failed to Add admin</div>";
        //Redirect Page to add Admin
        header("location:".SITEURl.'admin/add-admin.php');

}
        
}  
?>
