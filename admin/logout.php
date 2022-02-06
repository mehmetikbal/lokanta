<?php
#include constants.php for siteurl
include('..\config\constants.php');

#1.destory the session
session_destroy();//unsets $_session['kadi']
#2. redirect to login page
header('location:'.SITEURl.'admin/login.php');





?>