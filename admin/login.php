<?php include('..\config\constants.php')?>

<html>
<head>
    <title>login-noto-pizza</title>
    <link rel="stylesheet" href="../css/admin.css">
    

</head>
<body class="bak">
    <div class="login">
        <h1 class="text-center">login</h1><br><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];//Displaying Session Message
            unset($_SESSION['login']);//REmoving Session Message
        } 
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];//Displaying Session Message
            unset($_SESSION['no-login-message']);//REmoving Session Message
        } 
        
        ?>  <br><br>
        <!-- login form starats -->
        <form action="" method="POST" class="text-center">
            Kullanci Adi : <br>
            <input type="text" name="kadi" placeholder="kullanci adniniz girin"><br><br>
            password : <br>
            <input type="password" name="sifre" placeholder="password girin"><br><br>
        <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
        </form>
        <p class="text-center">created by - <a href="https://mehmetikbal97.github.io/MY-CV/">MEHMET IKBAL</a></p>
    </div>
</body>
</html>
<?php
#check wheter the submit button is clicked or not 
if(isset($_POST['submit']))
{
    #process for login 
    #1.get the data from login form 
     $kadi=$_POST['kadi'];
     $sifre=md5($_POST['sifre']);
    #2. sql to check whether the kadi and sifre exists or not
    $sql = "SELECT * FROM tbl_admin WHERE kadi='$kadi' AND  sifre='$sifre'";
    #3.execute the query
    $res = mysqli_query($conn, $sql);
    #4.count rows to check whether the kadi exists or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user avalibale and login success
        $_SESSION['login']="<div class='success'>login successful.</div>";
        $_SESSION['kadi']= $kadi;#to check whether the user is logged in or not and loggout will unset it
        //redirect to home page 
        header('location:'.SITEURl.'admin/');

    }
    else
    {
                //user avalibale and login success
                $_SESSION['login']="<div class='eror text-center'>kullanci adi yada sifre yanlistir.</div>";
                //redirect to home page 
                header('location:'.SITEURl.'admin/login.php');

    }
}




?>