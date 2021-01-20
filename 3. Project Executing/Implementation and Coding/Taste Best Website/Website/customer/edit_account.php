<?php 
if (isset($_SESSION['customer_id']))
{
    $userid= $_SESSION['customer_id'];
}
else if (isset($_SESSION['admin_id']))
{
    $userid=$_SESSION['admin_id'];
}

$get_customer = "select * from USERA where USER_ID='$userid'";

$run_customer = oci_parse($conn,$get_customer);

oci_execute($run_customer);

if(!$run_customer)
        {
             echo "An error occurred in parsing the sql string.\n"; 
            exit; 
        }

$row_customer = oci_fetch_array($run_customer);

$customer_id = $row_customer['USER_ID'];
        
$customer_name = $row_customer['USERNAME'];

$customer_pass = $row_customer['USER_PASSWORD'];

$customer_email = $row_customer['USER_EMAIL'];

$customer_phone = $row_customer['USER_PHONE'];

$customer_address = $row_customer['USER_ADDRESS'];

$customer_image = $row_customer['USER_IMAGE'];

$customer_description = $row_customer['USER_DESCRIPTION'];
    
?>

<h1 align="center"> Edit Your Account </h1>

<form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Customer Username </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $customer_name; ?>" name="c_name" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label">Customer E-mail </label> 
                      
                    <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $customer_email; ?>"  name="c_email" type="text" class="form-control" required>
                          
                     </div><!-- col-md-6 Finish -->

                     </div><!-- form-group Finish -->


                    <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Customer Address </label> 
                      
                    <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                    <input value="<?php echo $customer_address; ?>"  name="c_address" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label">Customer Password </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $customer_pass; ?>"  name="c_pass" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label">Customer Contact </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $customer_phone; ?>"  name="c_phone" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   

                   
                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Customer Image </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="c_image" type="file" class="form-control" required>
                         
                          <img src="customer_images/<?php echo $customer_image; ?>"  width="70" height="70">

                      </div><!-- col-md-6 Finish -->
                      </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label">Customer Description </label> 
                      
                      <div class="col-md-6">                        
                          <textarea name="c_desc"  cols="19" rows="6" class="form-control">
                          <?php echo $customer_description; ?>
                          </textarea>
                          
                      </div>                      
                   </div>

                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="update" value="Update Customer" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
    
    
<?php 

if(isset($_POST['update'])){
    
   
    
    $c_name = $_POST['c_name'];
   
    
    $c_email = $_POST['c_email'];
    

    $c_address = $_POST['c_address'];
    

    $c_pass = $_POST['c_pass'];
   

    $c_contact = $_POST['c_phone'];
    

    $c_desc = $_POST['c_desc'];
    
    
    $c_image = $_FILES['c_image']['name'];
    

    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    move_uploaded_file ($c_image_tmp,"customer_images/$c_image");
    

    $update_user = "UPDATE USERA SET USERNAME='$c_name',USER_EMAIL='$c_email',USER_PASSWORD='$c_pass',USER_PHONE='$c_contact',USER_ADDRESS='$c_address',USER_DESCRIPTION='$c_desc',USER_IMAGE='$c_image' where USER_ID='$userid'";
    $run_user = oci_parse($conn,$update_user);

    oci_execute($run_user);
    
    if($run_user){
        
        echo "<script>alert('Your account has been updated successfully. Please login again.')</script>";
        
        echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>

