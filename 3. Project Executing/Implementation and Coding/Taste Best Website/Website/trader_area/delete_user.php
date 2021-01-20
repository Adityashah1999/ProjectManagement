<?php 
    
    //session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['delete_user'])){
        
        $delete_id = $_GET['delete_user'];
        
        
        $delete_customer = "UPDATE USERA SET USER_STATUS='ACTIVATE_AGAIN' where USER_ID='$delete_id'";
    
    $run_delete_customer = oci_parse($conn,$delete_customer);

    oci_execute($run_delete_customer);
    
    if($run_delete_customer){
        
        session_destroy();
        
        echo "<script>alert('Your account has been deactivated successfully.)</script>";
        

echo "<script>window.open('../index.php','_self')</script>";
        
        
    }
}
    }

?>
