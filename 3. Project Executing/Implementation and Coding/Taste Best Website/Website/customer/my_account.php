<?php 

session_start();
include('includes/db.php');
include('includes/header.php');
include('includes/banner.include.php');

if(isset( $_SESSION['customer_id'] )|| isset( $_SESSION['admin_id']) ){
    if (isset($_SESSION['admin_id'])){

        $id=$_SESSION['admin_id'];

    }else if((isset($_SESSION['customer_id']))){

        $id=$_SESSION['customer_id'];
    }


if(isset($id)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taste Best</title>
    <link rel="stylesheet" href="styles/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
   
     
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
       <div class="col-md-12"></div>
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="../index.php">Home</a>
                   </li>
                   <li>
                       My Account
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="col-md-3"><!-- col-md-3 Begin -->
   
   <?php 
    
    include("includes/sidebar.php");
    
    ?>
               
           </div><!-- col-md-3 Finish -->
           
           <div class="col-md-9"><!-- col-md-9 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
                   <?php
                   
                   if (isset($_GET['my_orders'])){
                       include("my_orders.php");
                   }
                   
                   ?>
                   
                   <?php
                   
                   if (isset($_GET['pay_offline'])){
                       include("pay_offline.php");
                   }
                   
                   ?>
                   
                   <?php
                   
                   if (isset($_GET['edit_account'])){
                       include("edit_account.php");
                   }
                   
                   ?>
                   
                   <?php
                   
                   if (isset($_GET['change_pass'])){
                       include("change_pass.php");
                   }
                   
                   ?>
                   
                   <?php
                   
                   if (isset($_GET['delete_account'])){
                       include("delete_account.php");
                   }
                   
                   ?>
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-9 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    
    
</body>
</html>
<?php } ?>
<?php }
else if(!isset( $_SESSION['customer_id'] )|| !isset( $_SESSION['admin_id']) )
{
    
    echo "<script>window.open('../login.php','_self')</script>";
    
} ?>