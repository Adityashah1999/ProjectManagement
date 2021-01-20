<?php
session_start();
if (isset($_SESSION['customer_id']) || isset($_SESSION['admin_id']))
{
include("include/header.include.php");
include("include/banner.include.php");
include("include/cart/cartcontent.include.php");
include("include/footer.include.php");
include("include/connection.php");
}
else{
    
    header('location: login.php');
 
 }
 