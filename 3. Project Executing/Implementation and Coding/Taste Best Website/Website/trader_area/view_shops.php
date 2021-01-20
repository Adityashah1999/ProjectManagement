<?php 
    
   // session_start();
    include("includes/connection.php");
    if($_SESSION['admin_type']!='trader'){
        echo "<script>window.open('../login.php','_self')</script>";
        
    }else{

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li>
                
                <i class="fa fa-dashboard"></i> Dashboard / View Shops
                
            </li>
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                
                    <i class="fa fa-tags fa-fw"></i> View Shops
                
                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-hover table-striped table-bordered"><!-- tabel tabel-hover table-striped table-bordered begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> Shop ID </th>
                                <th> Shop Name </th>
                                <th> Shop Description </th>
                                <th> Shop Image </th>
                                <th> Edit Shop </th>
                                <th> Delete Shop </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            
                            <?php 
                            
                                $i=0;
          
                                $get_shop = "select * from SHOP";
          
                                $run_shop = oci_parse($conn,$get_shop);

                                oci_execute($run_shop);
          
                                while($row_shop=oci_fetch_array($run_shop)){
                                    
                                    $shop_id = $row_shop['SHOP_ID'];
                                    
                                    $shop_title = $row_shop['SHOP_NAME'];
                                    
                                    $shop_desc = $row_shop['SHOP_DESCRIPTION'];

                                    $shop_img = $row_shop['SHOP_IMAGE'];
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr><!-- tr begin -->
                                <td> <?php echo $shop_id ?> </td>
                                <td> <?php echo $shop_title; ?> </td>
                                <td> <?php echo $shop_desc; ?> </td>
                             <td> <img src="shop_images/<?php echo $shop_img; ?>" width="60" height="60"></td>
                                <td>    
                                <a href="index.php?delete_shop=<?php echo $shop_id; ?>">
                                     
                                     <i class="fa fa-trash-o"></i> Delete
                                 
                                  </a> 
                                  
                             </td>
                                <td> 
                                     
                                     <a href="index.php?edit_shops=<?php echo $shop_id; ?>">
                                     
                                        <i class="fa fa-pencil"></i> Edit
                                    
                                     </a> 
                                    
                                </td>
                               
                            </tr><!-- tr finish -->
                            
                            <?php } ?>
                        
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- tabel tabel-hover table-striped table-bordered finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->


<?php } ?>