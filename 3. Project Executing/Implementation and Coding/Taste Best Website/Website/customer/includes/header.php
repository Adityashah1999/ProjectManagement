<?php include("db.php"); ?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>TasteBest</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="../images/favicon.ico">
	<link rel="apple-touch-icon" href="../images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/plugins.css">
	<link rel="stylesheet" href="../style.css">
	<!-- Cusom css -->
   <link rel="stylesheet" href="../css/custom.css">
	<!-- Modernizer js -->
	<script src="../js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<div class="logo">
							<a href="../index.php">
								<img src="../images/logo/logo.png" alt="logo images" width="75%">
							</a>
						</div>
					</div>
					<div class="col-lg-8 d-none d-lg-block">
						<nav class="mainmenu__nav">
							<ul class="meninmenu d-flex justify-content-start">
								<li class="drop with--one--item"><a href="../index.php">Home</a></li>
								<li class="drop"><a href="../products.php">Products</a>
									<div class="megamenu mega03" style="width:auto;">
										<ul class="item item03">
											<li class="title">SHOPS</li>

											<?php

								$sql_login = "	SELECT * FROM  SHOP"; 

								$login_stmt = oci_parse($conn, $sql_login);

								if(!$login_stmt)
								{
									echo "An error occurred in parsing the sql string.\n"; 
									exit; 
								}

								oci_execute($login_stmt);
								while ($row = oci_fetch_assoc($login_stmt))
								{
									
									$SHOPID = $row['SHOP_ID'];
									$SHOP_NAME= $row['SHOP_NAME'];

									echo "
									<li><a href='../products.php?shop=$SHOPID'>$SHOP_NAME</a></li>
									
									";
								
								
								}
									

								?>
										</ul>
										<ul class="item item03">
											<li class="title">Categories</li>
											<?php

								$sql_login = "	SELECT * FROM  CATEGORY C"; 

								$login_stmt = oci_parse($conn, $sql_login);

								if(!$login_stmt)
								{
									echo "An error occurred in parsing the sql string.\n"; 
									exit; 
								}

								oci_execute($login_stmt);
								while ($row = oci_fetch_assoc($login_stmt))
								{
									
									$category = $row['CATEGORY_ID'];
									$category_name= $row['CATEGORY_NAME'];

									echo "
									<li><a href='../products.php?category=$category'>$category_name</a></li>
									
									";
								
								
								}
									

								?>
										</ul>
									</div>
								</li>
								<li class="drop"><a href="../traders.php">Traders</a>
								</li>
								<li class="drop"><a href="../About.php">About</a>
								</li>
								<?php
								if (isset( $_SESSION['customer_id'] )|| isset( $_SESSION['admin_id']) )

								{
									echo "<li><a href='my_account.php?edit_account'>My Account</a></li>";
								}
?>
							</ul>
						</nav>
					</div>
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<ul class="header__sidebar__right d-flex justify-content-end align-items-center">
							<li class="shop_search"><a class="search__active" href="#"></a></li>
							<li class="wishlist"><a href="../wishlist.php"></a></li>
							<li class="shopcart"><a  href="../cart.php"><span class="product_qun">3</span></a>
							</li>
							<li class="setting__bar__icon"><a  href="../login.php"></a>
							</li>
						</ul>
					</div>
				</div>
				<!-- Start Mobile Menu -->
				<div class="row d-none">
					<div class="col-lg-12 d-none">
						<nav class="mobilemenu__nav">
							<ul class="meninmenu">
								<li><a href="../index.php">Home</a></li>
								<li><a href="../products.php">Products</a>
								<ul>
											<?php

								$sql_login = "	SELECT * FROM  CATEGORY C"; 

								$login_stmt = oci_parse($conn, $sql_login);

								if(!$login_stmt)
								{
									echo "An error occurred in parsing the sql string.\n"; 
									exit; 
								}

								oci_execute($login_stmt);
								while ($row = oci_fetch_assoc($login_stmt))
								{
									
									$category = $row['CATEGORY_ID'];
									$category_name= $row['CATEGORY_NAME'];

									echo "
									<li><a href='../products.php?category=$category'>$category_name</a></li>
									
									";								
								}
								?>
										</ul>
								</li>
								<li><a href="../traders.php">Traders</a>
								</li>
								<li><a href="../about.php">About</a>
								</li>
								<li><a href="my_account.php?edit_account">My Account</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- End Mobile Menu -->
	            <div class="mobile-menu d-block d-lg-none">
	            </div>
	            <!-- Mobile Menu -->	
			</div>		
		</header>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<div class="brown--color box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="products.php">
				<div class="field__search">
					<input type="text" name="searchkeyword" placeholder="Search entire store here...">
					<div class="action">
						<button type ="searchsubmit"><a><i class="zmdi zmdi-search"></a></i></button>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
			
		</div>
		<!-- End Search Popup -->