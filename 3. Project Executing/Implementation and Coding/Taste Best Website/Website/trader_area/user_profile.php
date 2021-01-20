<?php 

//session_start();
include("includes/connection.php");
if($_SESSION['admin_type']!='trader'){
    echo "<script>window.open('../login.php','_self')</script>";
    
}else{

?>
   
<?php 

    if(isset($_GET['user_profile'])){
        
        $edit_user = $_GET['user_profile'];
        
        $get_user = "select * from usera where USER_ID='$edit_user'";
        
        $run_user = oci_parse($conn,$get_user);

        if(!$run_user)
        {
             echo "An error occurred in parsing the sql string.\n"; 
            exit; 
        }

        oci_execute($run_user);

        $row_user = oci_fetch_array($run_user);

        $user_id = $row_user['USER_ID'];
        
        $user_name = $row_user['USERNAME'];
        
        $user_pass = $row_user['USER_PASSWORD'];
        
        $user_email = $row_user['USER_EMAIL'];
        
        $user_phone = $row_user['USER_PHONE'];
        
        $user_address = $row_user['USER_ADDRESS'];

        $user_image = $row_user['USER_IMAGE'];

        $user_desc = $row_user['USER_DESCRIPTION'];
        
    }

?>
    
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <ol class="breadcrumb"><!-- breadcrumb Begin -->
            
            <li class="active"><!-- active Begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / Edit User
                
            </li><!-- active Finish -->
            
        </ol><!-- breadcrumb Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->
       
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <div class="panel panel-default"><!-- panel panel-default Begin -->
            
           <div class="panel-heading"><!-- panel-heading Begin -->
               
               <h3 class="panel-title"><!-- panel-title Begin -->
                   
                   <i class="fa fa-money fa-fw"></i> Edit User
                   
               </h3><!-- panel-title Finish -->
               
           </div> <!-- panel-heading Finish -->
           
           <div class="panel-body"><!-- panel-body Begin -->
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Username </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $user_name; ?>" name="admin_name" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> E-mail </label> 
                      
                    <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $user_email; ?>"  name="admin_email" type="text" class="form-control" required>
                          
                     </div><!-- col-md-6 Finish -->

                     </div><!-- form-group Finish -->


                    <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Address </label> 
                      
                    <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                    <input value="<?php echo $user_address; ?>"  name="admin_address" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Password </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $user_pass; ?>"  name="admin_pass" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Contact </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input value="<?php echo $user_phone; ?>"  name="admin_phone" type="text" class="form-control" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   
                   <div class="form-group"><!-- form-group Begin -->

                      <label class="col-md-3 control-label"> Image </label>

                      <div class="col-md-6"><!-- col-md-6 Begin -->

                          <input name="admin_image" type="file" class="form-control" required>

                          <img src="trader_images/<?php echo $user_image; ?>" alt="<?php echo $user_name; ?>" width="70" height="70">

                      </div><!-- col-md-6 Finish -->

                   </div><!-- form-group Finish -->

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> User Description </label> 
                      
                      <div class="col-md-6">                        
                          <textarea name="admin_desc"  cols="19" rows="6" class="form-control">

                          <?php echo $user_desc; ?>
                          
                          </textarea>
                          
                      </div>                      
                   </div>

                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="update" value="Update User" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->


<?php 

if(isset($_POST['update'])){
    
    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_pass'];
    $user_contact = $_POST['admin_phone'];
    $user_address= $_POST['admin_address'];
    $user_desc = $_POST['admin_desc'];
    $user_image = $_FILES['admin_image']['name'];
    $temp_admin_image = $_FILES['admin_image']['tmp_name'];

    move_uploaded_file($temp_admin_image,"trader_images/$user_image");

    $update_user = "update usera set USERNAME='$user_name',USER_EMAIL='$user_email',USER_PASSWORD='$user_pass',USER_PHONE='$user_contact',USER_ADDRESS='$user_address',USER_DESCRIPTION='$user_desc',USER_IMAGE='$user_image' where USER_ID='$user_id'";
    $run_user = oci_parse($conn,$update_user);

    oci_execute($run_user);
    
    if($run_user){
        
        echo "<script>alert('User has been updated sucessfully')</script>";
        echo "<script>window.open('index.php?view_users','_self')</script>"; 
        
    }
    
}

?>


<?php } ?>