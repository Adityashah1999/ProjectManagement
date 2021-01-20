<?php 
    
    //session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['edit_shops'])){
        
        $edit_shop_id = $_GET['edit_shops'];
        
        $edit_shop_query = "select * from SHOP where SHOP_ID='$edit_shop_id'";
        
        $run_edit = oci_parse($conn,$edit_shop_query);

        oci_execute($run_edit);
        
        $row_edit = oci_fetch_array($run_edit);

        if(!$run_edit){
            echo "Sql error";
        }

        $shop_id = $row_edit['SHOP_ID'];
        
        $shop_title = $row_edit['SHOP_NAME'];
        
        $shop_desc = $row_edit['SHOP_DESCRIPTION'];

        $shop_img = $row_edit['SHOP_IMAGE'];
        
    }

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li>
                
                <i class="fa fa-dashboard"></i> Dashboard / Edit Shop
                <a href="../index.php" class="btn btn-warning">Visit Website</a>
                
            </li>
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                
                    <i class="fa fa-pencil fa-fw"></i> Edit Shop
                
                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <form action="" class="form-horizontal" method="post"><!-- form-horizontal begin -->
                    <div class="form-group"><!-- form-group begin -->
                    
                        <label for="" class="control-label col-md-3"><!-- control-label col-md-3 begin --> 
                        
                            Shop Name
                        
                        </label><!-- control-label col-md-3 finish --> 
                        
                        <div class="col-md-6"><!-- col-md-6 begin -->
                        
                            <input value=" <?php echo $shop_title; ?> " name="shop_title" type="text" class="form-control">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
                    

                    
                    <div class="form-group"><!-- form-group begin -->
                    
                        <label for="" class="control-label col-md-3"><!-- control-label col-md-3 begin --> 
                        
                            SHOP Description
                        
                        </label><!-- control-label col-md-3 finish --> 
                        
                        <div class="col-md-6"><!-- col-md-6 begin -->
                        
                          
                        <textarea name="shop_desc" cols="19" rows="6" class="form-control">
                              
                              <?php echo $shop_desc; ?>
                              
                          </textarea>
                        
                        </div><!-- col-md-6 finish -->
                    </div><!-- form-group finish -->

                    <div class="form-group"><!-- form-group begin -->
                    
                        <label for="" class="control-label col-md-3"><!-- control-label col-md-3 begin --> 
                        
                             
                        
                        </label><!-- control-label col-md-3 finish --> 
                        
                        <div class="col-md-6"><!-- col-md-6 begin -->
                        
                            <input value="Update" name="update" type="submit" class="form-control btn btn-primary">
                        
                        </div><!-- col-md-6 finish -->
                    
                    </div><!-- form-group finish -->
                </form><!-- form-horizontal finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

<?php  

          if(isset($_POST['update'])){
              
              $shop_title = $_POST['shop_title'];
              
              $shop_desc = $_POST['shop_desc'];

             

              $update_shop = "update SHOP set SHOP_NAME='$shop_title',SHOP_DESCRIPTION='$shop_desc' where SHOP_ID='$shop_id'";
              
              $run_shop = oci_parse($conn,$update_shop);
              
              oci_execute($run_shop);
              if($run_shop){

                $insert_message="<div class='alert alert-success' role='alert'>
                Your Shop Has Been Updated
                </div>";
                echo $insert_message;
                  
                //   echo "<script>alert('')</script>";
                  
                  
              }
              
          }

?>



<?php } ?> 