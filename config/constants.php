<?php
  //start Session
  session_start();
//3. Executing Query and Saving Data into Datbase
  //creat constants to store non repeating values 

  
 define('SITEURl', 'http://localhost/admin/food/');


  define('LOCALHOST','localhost') ;
  define('DB_USERNAME','root') ;        
  define('DB_PASSWORD','') ;        
  define('DB_NAME','lokanta') ;        

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD ) or die(mysqli_error()); //Database Connection  
$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //SElecting Database



?>