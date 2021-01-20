<?php 
include("includes/connection.php");
if($_SESSION['admin_type']!='trader'){
    echo "<script>window.open('../login.php','_self')</script>";
    
}else{

?>

<?php 

    if(isset($_GET['edit_product'])){
        
        $edit_id = $_GET['edit_product'];
        
        $get_p = "select * from PRODUCT where PRODUCT_ID='$edit_id'";
        
        $run_edit = oci_parse($conn,$get_p);

        oci_execute($run_edit);
        
        $row_edit = oci_fetch_array($run_edit);

        
        
        $p_id = $row_edit['PRODUCT_ID'];
        
        $p_title = $row_edit['PRODUCT_NAME'];
        
        $cat = $row_edit['CATEGORY_ID'];

        $shop = $row_edit['SHOP_ID'];

        $discount = $row_edit['DISCOUNT_ID'];

        $review = $row_edit['REVIEW_ID'];
        
        $p_image1 = $row_edit['PRODUCT_IMAGE'];
        
        $p_price = $row_edit['PRODUCT_PRICE'];
        
        $p_keywords = $row_edit['PRODUCT_KEYWORDS'];
        
        $p_desc = $row_edit['PRODUCT_DESCRIPTION'];

        $max_order=$row_edit['MAX_ORDER'];

        $min_order=$row_edit['MIN_ORDER'];

        $allergy_information=$row_edit['ALLERGY_INFORMATION'];
        
    }
        
        
        $get_cat = "select * from CATEGORY where CATEGORY_ID='$cat'";
        
        $run_cat = oci_parse($conn,$get_cat);
        
        oci_execute($run_cat);

        if(!$run_cat){
            echo "Error while parsing";
        }

        $row_cat = oci_fetch_array($run_cat);

        $cat_title = $row_cat['CATEGORY_NAME'];


        $get_shop = "select * from SHOP where SHOP_ID='$shop'";
        
        $run_shop = oci_parse($conn,$get_shop);
        
        oci_execute($run_shop);

        if(!$run_shop){
            echo "Error while parsing";
        }

        $row_shop = oci_fetch_array($run_shop);
        
        $shop_title = $row_shop['SHOP_NAME'];

        $get_review = "select * from REVIEW where REVIEW_ID='$review'";
        
        $run_review = oci_parse($conn,$get_review);
        
        oci_execute($run_review);

        if(!$run_review){
            echo "Error while parsing";
        }

        $row_review = oci_fetch_array($run_review);
        
        $review_title = $row_review['REVIEW_COMMENT'];


        $get_discount = "select * from DISCOUNT where DISCOUNT_ID='$discount'";
        
        $run_discount = oci_parse($conn,$get_discount);
        
        oci_execute($run_discount);

        if(!$run_discount){
            echo "Error while parsing";
        }

        $row_discount = oci_fetch_array($run_discount);

        $discount_percentage = $row_discount['DISCOUNT_PERCENTAGE'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Edit Products </title>
</head>
<body>
    
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <ol class="breadcrumb"><!-- breadcrumb Begin -->
            
            <li class="active"><!-- active Begin -->
                
                <i class="fa fa-dashboard"></i> Dashboard / Edit Products
                
            </li><!-- active Finish -->
            
        </ol><!-- breadcrumb Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->
       
<div class="row"><!-- row Begin -->
    
    <div class="col-lg-12"><!-- col-lg-12 Begin -->
        
        <div class="panel panel-default"><!-- panel panel-default Begin -->
            
           <div class="panel-heading"><!-- panel-heading Begin -->
               
               <h3 class="panel-title"><!-- panel-title Begin -->
                   
                   <i class="fa fa-money fa-fw"></i> Edit Product 
                   <a href="../index.php" class="btn btn-warning">Visit Website</a>
                   
               </h3><!-- panel-title Finish -->
               
           </div> <!-- panel-heading Finish -->
           
           <div class="panel-body"><!-- panel-body Begin -->
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"><!-- form-horizontal Begin -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Title </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="product_title" type="text" class="form-control" required value="<?php echo $p_title; ?>">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   
                   <div class="form-group"> 
                       
                       <label class="col-md-3 control-label"> Category </label> 
                       
                       <div class="col-md-6"> 
                           
                           <select name="cat" class="form-control" > 
                               
                           <option value="<?php echo $cat; ?>"> <?php echo $cat_title; ?> </option>
                              
                               
                               <?php 
                               
                               $get_cat = "select * from CATEGORY";
                               $run_cat = oci_parse($conn,$get_cat);
                               if(!$run_cat)
                                 {
                                 echo "An error occurred in parsing the sql string.\n"; 
                                  exit; 
                                 }
                               oci_execute($run_cat);
                               while ($row_cat=oci_fetch_array($run_cat)){
                                   
                                   $cat_id = $row_cat['CATEGORY_ID'];
                                   $cat_title = $row_cat['CATEGORY_NAME'];
                                   
                                   echo "
                                   
                                   <option value='$cat_id'> $cat_title </option>
                                   
                                   ";
                                   
                               }
                               
                               ?>
                               
                           </select>
                           
                       </div>                      
                    </div>
                   
                   <div class="form-group"> 
                       
                       <label class="col-md-3 control-label"> Shop </label> 
                       
                       <div class="col-md-6"> 
                           
                           <select name="shop" class="form-control"> 
                               
                           <option value="<?php echo $shop; ?>"> <?php echo $shop_title; ?> </option>
                               
                               <?php 
                               
                               $get_shop = "select * from SHOP";

                               $run_shop = oci_parse($conn,$get_shop);
                               
                               if(!$run_shop)
                                {
                                    echo "An error occurred in parsing the sql string.\n"; 
                                    exit; 
                                }
                               oci_execute($run_shop);

                               while ($row_shop=oci_fetch_array($run_shop)){
                                   
                                   $shop_id = $row_shop['SHOP_ID'];
                                   $shop_title = $row_shop['SHOP_NAME'];
                                   
                                   echo "
                                   
                                   <option value='$shop_id'> $shop_title </option>
                                   
                                   ";
                                   
                               }
                               
                               ?>
                               
                           </select>
                           
                       </div>                      
                    </div>
                    
                    <div class="form-group"> 
                       
                       <label class="col-md-3 control-label"> Discount </label> 
                       
                       <div class="col-md-6"> 
                           
                           <select name="discount" class="form-control"> 
                               
                           <option value="<?php echo $discount; ?>"> <?php echo $discount_percentage; ?> </option>
                               
                               <?php 
                               
                               $get_discount = "select * from DISCOUNT";

                               $run_discount = oci_parse($conn,$get_discount);
                               
                               if(!$run_discount)
                                {
                                    echo "An error occurred in parsing the sql string.\n"; 
                                    exit; 
                                }
                               oci_execute($run_discount);

                               while ($row_discount=oci_fetch_array($run_discount)){
                                   
                                   $discount_id = $row_discount['DISCOUNT_ID'];
                                   $discount_per = $row_discount['DISCOUNT_PERCENTAGE'];
                           
                                   echo "
                                   
                                   <option value='$discount_id'> $discount_per </option>
                                   
                                   ";
                                   
                               }
                               
                               ?>
                               
                           </select>
                           
                       </div>                      
                    </div>
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Image 1 </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="product_img1" type="file" class="form-control" required>
                          
                          <br>
                          
                          <img width="70" height="70" src="product_images/<?php echo $p_image1; ?>"  alt="<?php echo $p_image1; ?>">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Price </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="product_price" type="text" class="form-control"  value="<?php echo $p_price; ?>" required>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Quality out of 5 </label> 
                      
                      <div class="col-md-6">                        
                          <input name="quality" type="number" min='1' max='5' class="form-control" value="<?php echo $review; ?>" required>
                          
                      </div>  
                      </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Keywords </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="product_keywords" type="text" class="form-control"  value="<?php echo $p_keywords; ?>" required">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"> Product Desc </label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <textarea name="product_desc" cols="19" rows="6" class="form-control">
                              
                              <?php echo $p_desc; ?>
                              
                          </textarea>
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Maximun Order </label> 
                      
                      <div class="col-md-6">                        
                          <input name="maximum_order" type="number" class="form-control" value="<?php echo $max_order; ?>" required>
                          
                      </div>                      
                   </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Minimum Order </label> 
                      
                      <div class="col-md-6">                        
                          <input name="minimum_order" type="number" class="form-control" value="<?php echo $min_order;?>"  required>
                          
                      </div>                      
                   </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Allergy Information </label> 
                      
                      <div class="col-md-6">                        
                          <textarea name="allergy_info" cols="19" rows="3" class="form-control">
                          <?php echo $allergy_information; ?>
                          </textarea>
                          
                      </div>                      
                   </div>
                   
                   
                   <div class="form-group"><!-- form-group Begin -->
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6"><!-- col-md-6 Begin -->
                          
                          <input name="update" value="Update Product" type="submit" class="btn btn-primary form-control">
                          
                      </div><!-- col-md-6 Finish -->
                       
                   </div><!-- form-group Finish -->
                   
               </form><!-- form-horizontal Finish -->
               
           </div><!-- panel-body Finish -->
            
        </div><!-- canel panel-default Finish -->
        
    </div><!-- col-lg-12 Finish -->
    
</div><!-- row Finish -->
   
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>


<?php 

if(isset($_POST['update'])){

    $product_title = $_POST['product_title'];

    $cat = $_POST['cat'];

    $shop=$_POST['shop'];

    $discount=$_POST['discount'];

    $review=$_POST['quality'];

    $user_id=$_SESSION['admin_id'];

    $product_price = $_POST['product_price'];

    $product_keywords = $_POST['product_keywords'];

    $product_desc = $_POST['product_desc'];

    $maximum_order=$_POST['maximum_order'];

    $minimum_order=$_POST['minimum_order'];

    $allergy_info=$_POST['allergy_info'];
    
    $product_img1 = $_FILES['product_img1']['name'];
    
    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    
    move_uploaded_file($temp_name1,"product_images/$product_img1");
   
    $update_product = "update PRODUCT set CATEGORY_ID='$cat', SHOP_ID='$shop',REVIEW_ID='$review', USER_ID='$user_id', DISCOUNT_ID='$discount', PRODUCT_NAME='$product_title',PRODUCT_IMAGE='$product_img1',PRODUCT_KEYWORDS='$product_keywords',PRODUCT_DESCRIPTION='$product_desc',PRODUCT_PRICE='$product_price', MIN_ORDER='$minimum_order', MAX_ORDER='$maximum_order', ALLERGY_INFORMATION='$allergy_info' where PRODUCT_ID='$p_id'";
    $run_product = oci_parse($conn,$update_product);
    
    oci_execute($run_product);

    if($run_product){
        
        
       $insert_message="<div class='alert alert-success' role='alert'>
       Your product has been updated Successfully
       </div>";
       echo $insert_message;
        
    }
    
}

?>


<?php } ?>