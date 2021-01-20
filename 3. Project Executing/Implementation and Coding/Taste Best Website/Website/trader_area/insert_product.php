<?php
//session_start();
include("includes/connection.php");
if($_SESSION['admin_type']!='trader'){
    echo "<script>window.open('../login.php','_self')</script>";
    
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Insert Products </title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
</head>
<body>
    
<div class="row"> 
    
    <div class="col-lg-12"> 
        
        <ol class="breadcrumb"> 
            
            <li class="active"> 
                
                <i class="fa fa-dashboard"></i> Dashboard / Insert Products
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
                   
                   <i class="fa fa-money fa-fw"></i> Insert Product 
                   
               </h3> 
             
               
           </div>  
           
           <div class="panel-body"> 
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data"> 
                   
                   <div class="form-group"> 
                       
                      <label class="col-md-3 control-label"> Product Title </label> 
                      
                      <div class="col-md-6"> 
                          
                          <input name="product_title" type="text" class="form-control" required>
                          
                      </div> 
                       
                   </div> 
                   
                    <div class="form-group"> 
                       
                      <label class="col-md-3 control-label"> Category </label> 
                      
                      <div class="col-md-6"> 
                          
                          <select name="cat" class="form-control"> 
                              
                              <option disabled selected hidden> Select a Category </option>
                              
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
                               
                               <option disabled selected hidden> Select a Shop type </option>
                               
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
                               
                               <option disabled selected hidden> Select a Discount Percentage </option>
                               
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
                    
                   
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Product Image 1 </label> 
                      
                      <div class="col-md-6">                        
                          <input name="product_img1" type="file" class="form-control" required>
                          
                      </div>                      
                   </div>
                    
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Product Price </label> 
                      
                      <div class="col-md-6">                        
                          <input name="product_price" type="text" class="form-control" required>
                          
                      </div>                      
                   </div>
                   
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Quality out of 5 </label> 
                      
                      <div class="col-md-6">                        
                          <input name="quality" type="number" min='1' max='5' class="form-control" required>
                          
                      </div>  

                   </div>
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Product Keywords </label> 
                      
                      <div class="col-md-6">                        
                          <input name="product_keywords" type="text" class="form-control" required>
                          
                      </div>                      
                   </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Product Status </label> 
                      
                      <div class="col-md-6">                        
                          <input name="product_status" type="text" class="form-control" required>
                          
                      </div>                      
                   </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Maximun Order </label> 
                      
                      <div class="col-md-6">                        
                          <input name="maximum_order" type="number" class="form-control" required>
                          
                      </div>                      
                   </div>
                   
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Minimum Order </label> 
                      
                      <div class="col-md-6">                        
                          <input name="minimum_order" type="number" class="form-control" required>
                          
                      </div>                      
                   </div>

                  

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Product Description </label> 
                      
                      <div class="col-md-6">                        
                          <textarea name="product_desc" cols="19" rows="6" type="text" class="form-control"></textarea>
                          
                      </div>                      
                   </div>

                   <div class="form-group">                       
                      <label class="col-md-3 control-label"> Allergy Information </label> 
                      
                      <div class="col-md-6">                        
                          <textarea name="allergy_info" cols="19" rows="3" type="text" class="form-control"></textarea>
                          
                      </div>                      
                   </div>
                   
                   <div class="form-group">                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6">                        
                          <input name="submit" value="Insert Product" type="submit" class="btn btn-primary form-control">
                          
                      </div>                      
                   </div>
                   
               </form>
               
           </div>
            
        </div>
        
    </div>    
</div>  
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script> 
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>


<?php 

if(isset($_POST['submit'])){
    
    $product_title = $_POST['product_title'];
    $userid=$_SESSION['admin_id'];
    $cat = $_POST['cat'];
    $shop=$_POST['shop'];
    $discount=$_POST['discount'];
    $review=$_POST['quality'];
    $product_price = $_POST['product_price'];
    $product_keywords = strtoupper($_POST['product_keywords']);
    $product_status = $_POST['product_status'];
    $product_desc = $_POST['product_desc'];
    $maximum_order=$_POST['maximum_order'];
    $minimum_order=$_POST['minimum_order'];
    $allergy_info=$_POST['allergy_info'];
    $product_img1 = $_FILES['product_img1']['name'];
    
    
    $temp_name1 = $_FILES['product_img1']['tmp_name'];

    
    move_uploaded_file($temp_name1,"product_images/$product_img1");

    
    
    $insert_product = "INSERT INTO PRODUCT (PRODUCT_NAME,PRODUCT_DESCRIPTION,PRODUCT_PRICE,PRODUCT_IMAGE,PRODUCT_KEYWORDS,PRODUCT_STATUS, MIN_ORDER,MAX_ORDER,ALLERGY_INFORMATION,CATEGORY_ID,SHOP_ID,DISCOUNT_ID,REVIEW_ID,USER_ID)
    VALUES
    ('$product_title',' $product_desc','$product_price','$product_img1','$product_keywords','$product_status','$minimum_order','$maximum_order','$allergy_info','$cat','$shop','$discount','$review','$userid')";
    
    $run_product = oci_parse($conn,$insert_product);

    

    oci_execute($run_product);
    
    if($run_product){
        

        
        $insert_message="<div class='alert alert-success' role='alert'>
        Your product has been inserted Successfully
</div>";
echo $insert_message;
         
        
    }
    else{
         
        $insert_message="<div class='alert alert-danger' role='alert'>
        Your product has not been inserted
</div>";
echo $insert_message;

    }
   
    
}
}
?>