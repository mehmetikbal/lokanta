<?php
       //include constants.php file here
        include('..\config\constants.php');
        //echo "delete page"; page kontolu
        

        #check whether the sinif_id and image+name value is set or not
        if(isset($_GET['sinif_id']) AND isset($_GET['image_name']))
        {
            //get the value and delete
           # echo "get value and delete";
           $sinif_id = $_GET['sinif_id'];
           $image_name = $_GET['image_name'];


           //remove the physical image file is available
                if($image_name != "")
                {
                    #image is available so remove it
                    $path = "../images/kategori/".$image_name;
                    //remove the image
                    $remove = unlink($path);

                    //if failed to remove image then add
                        if($remove==false)
                        {
                                //set the session mesage
                                $_SESSION['remove'] = "<div class='eror'>failed to remove kategori image.</div>";
                                //redirect to manage kategori page
                                header('location:'.SITEURl.'admin/kategori.php');    

                                //stop the  process
                                die();
                        }
                }
                //delete data from database 
                //sql query to delete data from database 
                $sql = "DELETE FROM tbl_kategori WHERE sinif_id=$sinif_id";

                //execute the query 
                $res = mysqli_query($conn , $sql);

                //check whether the data is delete from database or not 
                if($res==true)
                {
                    //set success message and redirect 
                    $_SESSION['delete'] = "<div class='success'>kategori deleted successful.</div>";
                    //redirect to manage kategori 
                    header('location:'.SITEURl.'admin/kategori.php');    

                }
                else
                {
                    //set fail message and redires
                    $_SESSION['delete'] = "<div class='eror'>failed to  deleted kategori .</div>";
                    //redirect to manage kategori 
                    header('location:'.SITEURl.'admin/kategori.php');   
                }
                

        }
        else
        {
            //redirect to mange kategori page
            header('location:'.SITEURl.'admin/kategori.php');    


        }


?>