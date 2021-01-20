
<?php 
    
   // session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                
                <i class="fa fa-dashboard"></i> Dashboard / View Products
                <a href="../index.php" class="btn btn-warning">Visit Website</a>
                
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">
               
                   <i class="fa fa-tags"></i>  View Products
                
               </h3>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead> 
                            <tr> 
                                <th> Product ID: </th>
                                <th> Product Title: </th>
                                <th> Product Image: </th>
                                <th> Product Price: </th>
                                <th> Product description: </th>
                                <th> Product Keywords: </th>
                                <th> Product Status: </th>
                                <th> Minimum Order: </th>
                                <th> Maximum Order: </th>
                                <th> Allergy Information: </th>
                                <th> Product Delete: </th>
                                <th> Product Edit: </th>
                            </tr> 
                        </thead> 
                        
                        <tbody> 
                            
                            <?php 
          
                                $i=0;
                                 $get_pro = "select * from PRODUCT where USER_ID='$admin_id'";
                               
                                
                                $run_pro = oci_parse($conn,$get_pro);
          
                                oci_execute($run_pro);

                                while($row_pro=oci_fetch_array($run_pro)){
                                    
                                    $pro_id = $row_pro['PRODUCT_ID'];
                                    
                                    $pro_title = $row_pro['PRODUCT_NAME'];
                                    
                                    $pro_img1 = $row_pro['PRODUCT_IMAGE'];

                                    $pro_desc = $row_pro['PRODUCT_DESCRIPTION'];
                                    
                                    $pro_price = $row_pro['PRODUCT_PRICE'];
                                    
                                    $pro_keywords = $row_pro['PRODUCT_KEYWORDS'];

                                    $pro_status = $row_pro['PRODUCT_STATUS'];

                                    $min_order=$row_pro['MIN_ORDER'];

                                    $max_order=$row_pro['MAX_ORDER'];
                                    
                                   $allergy_detail=$row_pro['ALLERGY_INFORMATION'];
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr> 
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $pro_title; ?> </td>
                                <td> <img src="product_images/<?php echo $pro_img1; ?>" width="60" height="60"></td>
                                <td> <?php echo $pro_price; ?> </td>
                                <td> <?php echo $pro_desc; ?> </td>
                                <td> <?php echo $pro_keywords; ?> </td>
                                <td> <?php echo $pro_status; ?> </td>
                                <td> <?php echo $min_order; ?> </td>
                                <td> <?php echo $max_order; ?> </td>
                                <td> <?php echo $allergy_detail; ?> </td>
                                <td> 
                                     
                                     <a href="index.php?delete_product=<?php echo $pro_id; ?>">
                                     
                                        <i class="fa fa-trash-o"></i> Delete
                                    
                                     </a> 
                                     
                                </td>
                                <td> 
                                     
                                     <a href="index.php?edit_product=<?php echo $pro_id; ?>">
                                     
                                        <i class="fa fa-pencil"></i> Edit
                                    
                                     </a> 
                                    
                                </td>
                            </tr> 
                            
                            <?php } ?>
                            
                        </tbody> 
                        
                    </table> 
                </div> 
            </div> 
            
        </div> 
    </div> 
</div> 

<?php 
} ?>