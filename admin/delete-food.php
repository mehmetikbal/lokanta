<?php 
//include constants.php file here
include('..\config\constants.php');
//echo "delet food page";
if(isset($_GET['y_id']) AND isset($_GET['image_name']))  //either use '&&' or 'AND'
{
    //process to delete
    //echo "process to delete";
    #1.get y_id and img name 
    $y_id = $_GET['y_id'];
    $image_name = $_GET['image_name'];
    #2.remove the img if available
    //check whether the img is available or not and delete only if available
    if($image_name != "")
    {
        //it haS IMG and need to remove frome folder
        //get the img path
        $path = "../images/food/".$image_name;
        //remov img faile from folder
        $remove = unlink($path);
        //check whether the img is removed or not 
        if($remove==false)
        {
            //failed to remove img
            $_SESSION['upload'] = "<div class='eror'>failed to remove img file</div>";
            //redirect to manage food
              header('location:'.SITEURl.'admin/yemek.php');   
            die();//stop the process of deleting food
        }
    }
    #3. delete food from database 
    $sql = "DELETE FROM tbl_yemek WHERE y_id=$y_id ";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the query executed or not set the session message respectively
        #4. redirect to manage food with session message

            if($res==true)
            {
                //food deleted 
                                    
                 $_SESSION['delete'] = "<div class='success'>food deleted successful.</div>";
                            
                  header('location:'.SITEURl.'admin/yemek.php'); 

            }
            else
            {
                //failed to delete food
                                
                 $_SESSION['delete'] = "<div class='eror'>failed to  deleted food .</div>";
                                    
                 header('location:'.SITEURl.'admin/yemek.php');
            }
}
else
{
    //redirect to manage food page
    //echo "redirect";
    $_SESSION['unauthorized'] = "<div class='eror'>unauthorized access .</div>";
    header('location:'.SITEURl.'admin/yemek.php');   


}


?>