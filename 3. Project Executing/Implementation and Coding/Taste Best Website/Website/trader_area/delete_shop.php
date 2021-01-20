<?php 
    
    //session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_shop'])){
        
        $delete_id = $_GET['delete_shop'];
        
        $delete_shop = "delete from SHOP where SHOP_ID='$delete_id'";
        
        $run_delete = oci_parse($conn,$delete_shop);

        oci_execute($run_delete);
        
        if($run_delete){
            
            echo "<script>alert('One of your shop has been Deleted')</script>";
            
            echo "<script>window.open('index.php?view_shops','_self')</script>";
            
        }
        
    }

?>

<?php } ?>