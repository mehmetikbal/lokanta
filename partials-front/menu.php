<?php
 include('config\constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTO PIZZA</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="NOTO PIZZA" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURl;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURl;?>Categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURl;?>Foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURl;?>mycart.php">MyCart</a>
                    </li>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->