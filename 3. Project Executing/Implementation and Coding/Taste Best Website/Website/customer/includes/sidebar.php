<div class="panel panel-default sidebar-menu" style='background-color:RGB(211, 215, 222);'><!--  panel panel-default sidebar-menu Begin  -->
    
    <div class="panel-heading"><!--  panel-heading  Begin  -->
        
        <?php 
        include("db.php");
       
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
        
        $row_customer = oci_fetch_assoc($run_customer);
        
        $customer_image = $row_customer['USER_IMAGE'];
        
        $customer_name = $row_customer['USERNAME'];

        $customer_email = $row_customer['USER_EMAIL'];

        $customer_phone = $row_customer['USER_PHONE'];

        $customer_address = $row_customer['USER_ADDRESS'];
        
        if(!isset($_SESSION['customer_id']) && !isset($_SESSION['admin_id'])){
            
        }else{
            if(isset($_SESSION['customer_id'])){
            echo "
              
                <center>
                
                    <img src='customer_images/$customer_image' class='img-responsive'  class='profile_image' >
                
                </center>
                
                <br/>
                
                <h6 class='panel-title' align='center' style='color:RGB(237, 146, 92);font-weight:bold;'>
                
                    Name: $customer_name
                    $customer_email
                    Contact: $customer_phone
                
                </h6>
            
            ";
            
        }else{
            echo "
              
            <center>
            
                <img src='../trader_area/trader_images/$customer_image' class='img-responsive'  class='profile_image' >
            
            </center>
            
            <br/>
            
            <h6 class='panel-title' align='center' style='color:RGB(237, 146, 92);font-weight:bold;'>
            
            Name: $customer_name
            $customer_email
            Contact: $customer_phone
            
            </h6>
        
        ";
        }
    }
        
        ?>
        
    </div><!--  panel-heading Finish  -->
    
    <div class="panel-body"><!--  panel-body Begin  -->
        
        <ul class="nav-pills nav-stacked nav"><!--  nav-pills nav-stacked nav Begin  -->
            
            <li class="<?php if(isset($_GET['my_orders'])){ echo "active"; } ?>">
                
                <a href="my_account.php?my_orders">
                    
                    <i class="fa fa-list"></i> My Orders
                    
                </a>
                
            </li>
            
            
            <li class="<?php if(isset($_GET['edit_account'])){ echo "active"; } ?>">
                
                <a href="my_account.php?edit_account">
                    
                    <i class="fa fa-pencil"></i> Edit Account
                    
                </a>
                
            </li>
            
         
            
            <li class="<?php if(isset($_GET['delete_account'])){ echo "active"; } ?>">
                
                <a href="my_account.php?delete_account">
                    
                    <i class="fa fa-trash-o"></i> Deactivate Account
                    
                </a>
                
            </li>
            
            <li>
                
                <a href="logout.php">
                    
                    <i class="fa fa-sign-out"></i> Log Out
                    
                </a>
                
            </li>
            
        </ul><!--  nav-pills nav-stacked nav Begin  -->
        
    </div><!--  panel-body Finish  -->
    
</div><!--  panel panel-default sidebar-menu Finish  -->