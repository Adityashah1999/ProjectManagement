<?php 
    
    //session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_product'])){
        
        $delete_id = $_GET['delete_product'];
        
        $delete_pro = "delete from PRODUCT where PRODUCT_ID='$delete_id'";
        
        $run_delete = oci_parse($conn,$delete_pro);

        oci_execute($run_delete);
        
        if($run_delete){
            
            echo "<script>alert('One of your product has been Deleted')</script>";
            
            echo "<script>window.open('index.php?view_products','_self')</script>";
            
        }
        
    }

?>

<?php } ?>