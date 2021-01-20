<center><!-- center Begin -->
    
    <h1> Are you sure you want to delete your account? </h1>
    
    <form action="" method="post"><!-- form Begin -->
        
       <input type="submit" name="Yes" value="Yes, I want to deactivate" class="btn btn-danger">
        
       <input type="submit" name="No" value="No, I don't want to deactivate" class="btn btn-primary">
        
    </form><!-- form Finish -->
    
</center><!-- center Finish -->


<?php 

$c_id = $_SESSION['customer_id'];

if(isset($_POST['Yes'])){
    
    $delete_customer = "UPDATE USERA SET USER_STATUS='ACTIVATE_AGAIN' where USER_ID='$c_id'";
    
    $run_delete_customer = oci_parse($conn,$delete_customer);

    oci_execute($run_delete_customer);
    
    if($run_delete_customer){
        
        session_destroy();
        
        echo "<script>alert('Your account has been deactivated successfully.)</script>";
        
session_destroy();

echo "<script>window.open('../index.php','_self')</script>";
        
        
    }
    
}

if(isset($_POST['No'])){
    
    echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    
}

?>