<?php 
    
   include("connection.php");

   $admin_name=$_SESSION['admin_name'];
   $admin_id= $_SESSION['admin_id'];
?>
   
<nav class="navbar navbar-inverse navbar-fixed-top" style="background:#008060;"><!-- navbar navbar-inverse navbar-fixed-top begin -->
    <div class="navbar-header"><!-- navbar-header begin -->
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><!-- navbar-toggle begin -->
            
            <span class="sr-only">Toggle Navigation</span>
            
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
        </button><!-- navbar-toggle finish -->
        
        <a href="index.php?dashboard" class="navbar-brand" style="color: white;">Trader Area</a>
        
    </div><!-- navbar-header finish -->
    
    <ul class="nav navbar-right top-nav"><!-- nav navbar-right top-nav begin -->
        
        <li class="dropdown"><!-- dropdown begin -->
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: black;"><!-- dropdown-toggle begin -->
                
                <i class="fa fa-user"></i> <?php echo $admin_name;  ?> <b class="caret"></b>
                
            </a><!-- dropdown-toggle finish -->
            
            <ul class="dropdown-menu"><!-- dropdown-menu begin -->
                <li><!-- li begin -->
                    <a href="index.php?user_profile=<?php echo $admin_id; ?>"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-user"></i> Profile
                        
                    </a><!-- a href finish -->
                </li><!-- li finish -->
                
                <li><!-- li begin -->
                    <a href="index.php?view_products"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-envelope"></i> Products
                        
                        <span class="badge"><?php echo $count_products; ?></span>
                        
                    </a><!-- a href finish -->
                </li><!-- li finish -->
                
                <li><!-- li begin -->
                    <a href="index.php?view_customers"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-users"></i> Customeres
                        
                        <span class="badge"><?php echo $count_customers; ?></span>
                        
                    </a><!-- a href finish -->
                </li><!-- li finish -->
                
                
                
                <li class="divider"></li>
                
                <li><!-- li begin -->
                    <a href="logout.php"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-power-off"></i> Log Out
                        
                    </a><!-- a href finish -->
                </li><!-- li finish -->
                
            </ul><!-- dropdown-menu finish -->
            
        </li><!-- dropdown finish -->
        
    </ul><!-- nav navbar-right top-nav finish -->
    
    <div class="collapse navbar-collapse navbar-ex1-collapse" ><!-- collapse navbar-collapse navbar-ex1-collapse begin -->
        <ul class="nav navbar-nav side-nav" style="background:#008060;"><!-- nav navbar-nav side-nav begin -->
            <li ><!-- li begin -->
                <a href="index.php?dashboard" style="color: yellow;"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard
                        
                </a><!-- a href finish -->
                
            </li><!-- li finish -->
            
            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#products" style="color: yellow;"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-tag"></i> Products
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a><!-- a href finish -->
                
                <ul id="products" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="index.php?insert_product" style="color: white;"> Insert Product </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_products" style="color: white;"> View Products </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->
                
            </li><!-- li finish -->
            
            
            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#cat" style="color: yellow;"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-book"></i> Categories
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a><!-- a href finish -->
                
                <ul id="cat" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="index.php?view_cats" style="color: white;"> View Categories </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->
                
            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#shop" style="color: yellow;"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-book"></i> Shops
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a><!-- a href finish -->
                
                <ul id="shop" class="collapse"><!-- collapse begin -->
                <li><!-- li begin -->
                        <a href="index.php?insert_shops" style="color: white;"> Insert Shops </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?view_shops" style="color: white;"> View Shops </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->
                
            </li><!-- li finish -->
            
          
            <li><!-- li begin -->
                <a href="index.php?view_customers" style="color: yellow;"><!-- a href begin -->
                    <i class="fa fa-fw fa-users"></i> View Customers
                </a><!-- a href finish -->
            </li><!-- li finish -->
            
            
            <li><!-- li begin -->
                <a href="#" data-toggle="collapse" data-target="#users" style="color: yellow;"><!-- a href begin -->
                        
                        <i class="fa fa-fw fa-users"></i> Profile
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a><!-- a href finish -->
                
                <ul id="users" class="collapse"><!-- collapse begin -->
                    <li><!-- li begin -->
                        <a href="index.php?view_users" style="color: white;"> View Profile </a>
                    </li><!-- li finish -->
                    <li><!-- li begin -->
                        <a href="index.php?user_profile=<?php echo $admin_id; ?>"style="color: white;"> Edit Profile </a>
                    </li><!-- li finish -->
                </ul><!-- collapse finish -->
                
            </li><!-- li finish -->
            
            <li><!-- li begin -->
                <a href="http://127.0.0.1:8080/apex/f?p=106:LOGIN_DESKTOP:5364829047718:::::" style="color: yellow;" ><!-- a href begin -->
                    <i class="fa fa-fw fa-power-off"></i>Trader Apex Interface
                </a><!-- a href finish -->
            </li><!-- li finish -->

            <li><!-- li begin -->
                <a href="logout.php" style="color: yellow;" ><!-- a href begin -->
                    <i class="fa fa-fw fa-power-off"></i>Log Out
                </a><!-- a href finish -->
            </li><!-- li finish -->
            
        </ul><!-- nav navbar-nav side-nav finish -->
    </div><!-- collapse navbar-collapse navbar-ex1-collapse finish -->
    
</nav><!-- navbar navbar-inverse navbar-fixed-top finish -->


<?php //} ?>