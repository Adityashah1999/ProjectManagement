<?php

	$sql_login = "	SELECT * FROM  CATEGORY"; 

	$login_stmt = oci_parse($conn, $sql_login);

	if(!$login_stmt)
	{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
	}

	oci_execute($login_stmt);

?>

<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style='background-color:RGB(211, 215, 222);'>
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
        				<div class="shop__sidebar">
        					<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">Product Categories</h3>
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
									<li><a href='products.php?category=$category'>$category_name</a></li>
									
									";
								
								
								}
									

								?>
        						</ul>
        					</aside>
							<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">SHOP Categories</h3>
        						<ul>

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
									<li><a href='products.php?shop=$SHOPID'>$SHOP_NAME</a></li>
									
									";
								
								
								}
									

								?>
        						</ul>
        					</aside>
							
        				
        	
        					
        				</div>
        			</div>
        			<div class="col-lg-9 col-12 order-1 order-lg-2">
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									<div class="shop__list nav justify-content-center" role="tablist">
			                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
			                        </div>
			                        <p>ALL PRODUCTS</p>
			                        
		                        </div>
        					</div>
        				</div>
        				<div class="tab__container">
	        				<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
	        					<div class="row">

								<?php
							


							if (isset($_GET['searchkeyword']))
							{
						$CID=strtoupper($_GET['searchkeyword']);
						$sql_login = "SELECT  * FROM PRODUCT p  where  PRODUCT_KEYWORDS LIKE '%$CID%' ";
						$login_stmt = oci_parse($conn, $sql_login);
					
							if(!$login_stmt)
							{
						echo "An error occurred in parsing the sql string.\n"; 
						exit; 
							}
					
					oci_execute($login_stmt);
					while (($row= oci_fetch_array($login_stmt))==true)
					{
						$productid = $row['PRODUCT_ID'];
						$productname = $row['PRODUCT_NAME'];
						$productdesc = $row ['PRODUCT_DESCRIPTION'];
						$productstatus =$row['PRODUCT_STATUS'];
						$productimage= $row['PRODUCT_IMAGE'];
						$productprice=$row['PRODUCT_PRICE'];
						$productkeywords= $row['PRODUCT_KEYWORDS'];
						$minimumorder= $row['MIN_ORDER'];
						$maximumorder = $row['MAX_ORDER'];
						$allergy =$row['ALLERGY_INFORMATION'];
						$category = $row['CATEGORY_ID'];
						$orderid=$row['ORDER_ID'];
						$shopid=$row['SHOP_ID'];
						$userid=$row['USER_ID'];
						$discountid= $row['DISCOUNT_ID'];
					
					
						echo "
					
						<!-- Start Single Product -->
						<div class='product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12'>
						<div class='product__thumb'>
							<a class='first__img' href='singleproduct.php?productdi=$productid'><img src='trader_area/product_images/$productimage' alt='$productname'></a>											
							<div class='hot__box'>
								<span class='hot-label'>$productstatus
								</span>
							</div>
						</div>
						<div class='product__content content--center'>
							<h4><a href='singleproduct.php'>$productname</a></h4>
							<ul class='prize d-flex'>
								<li>$ $productprice</li>
							</ul>
							<div class='action'>
													<div class='actions_inner'>
														<ul class='add_to_links'>
															<li><a class='cart' href='include/cart/cartadder.include.php?productid=$productid'><i class='bi bi-shopping-bag4'></i></a></li>
															<li><a class='compare' href='index.php?wishadd=$productid'><i class='bi bi-heart-beat'></i></a></li>
														</ul>
													</div>
												</div>
						</div>
						</div>
						<!-- End Single Product -->
					
						";
					
					
					}
					
					
					}
		else if (isset($_GET['category']))
		{
	$CID=$_GET['category'];
	$sql_login = "SELECT  * FROM PRODUCT p  where  CATEGORY_ID = $CID ";
	$login_stmt = oci_parse($conn, $sql_login);

		if(!$login_stmt)
		{
	echo "An error occurred in parsing the sql string.\n"; 
	exit; 
		}

oci_execute($login_stmt);
while (($row= oci_fetch_array($login_stmt))==true)
{
	$productid = $row['PRODUCT_ID'];
	$productname = $row['PRODUCT_NAME'];
	$productdesc = $row ['PRODUCT_DESCRIPTION'];
	$productstatus =$row['PRODUCT_STATUS'];
	$productimage= $row['PRODUCT_IMAGE'];
	$productprice=$row['PRODUCT_PRICE'];
	$productkeywords= $row['PRODUCT_KEYWORDS'];
	$minimumorder= $row['MIN_ORDER'];
	$maximumorder = $row['MAX_ORDER'];
	$allergy =$row['ALLERGY_INFORMATION'];
	$category = $row['CATEGORY_ID'];
	$orderid=$row['ORDER_ID'];
	$shopid=$row['SHOP_ID'];
	$userid=$row['USER_ID'];
	$discountid= $row['DISCOUNT_ID'];


	echo "

	<!-- Start Single Product -->
	<div class='product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12'>
	<div class='product__thumb'>
		<a class='first__img' href='singleproduct.php?productdi=$productid'><img src='trader_area/product_images/$productimage' alt='$productname'></a>											
		<div class='hot__box'>
			<span class='hot-label'>$productstatus
			</span>
		</div>
	</div>
	<div class='product__content content--center'>
		<h4><a href='singleproduct.php'>$productname</a></h4>
		<ul class='prize d-flex'>
			<li>$ $productprice</li>
		</ul>
		<div class='action'>
		<div class='actions_inner'>
		<ul class='add_to_links'>
			<li><a class='cart' href='include/cart/cartadder.include.php?productid=$productid'><i class='bi bi-shopping-bag4'></i></a></li>
			<li><a class='compare' href='index.php?wishadd=$productid'><i class='bi bi-heart-beat'></i></a></li>
		</ul>
	</div>
							</div>
	</div>
	</div>
	<!-- End Single Product -->

	";


}


}

else if (isset($_GET['shop']))
{
$CID=$_GET['shop'];
$sql_login = "SELECT  * FROM PRODUCT p where  SHOP_ID = $CID ";
$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
echo "An error occurred in parsing the sql string.\n"; 
exit; 
}

oci_execute($login_stmt);

while (($row= oci_fetch_array($login_stmt))==true)
{
	$productid = $row['PRODUCT_ID'];
	$productname = $row['PRODUCT_NAME'];
	$productdesc = $row ['PRODUCT_DESCRIPTION'];
	$productstatus =$row['PRODUCT_STATUS'];
	$productimage= $row['PRODUCT_IMAGE'];
	$productprice=$row['PRODUCT_PRICE'];
	$productkeywords= $row['PRODUCT_KEYWORDS'];
	$minimumorder= $row['MIN_ORDER'];
	$maximumorder = $row['MAX_ORDER'];
	$allergy =$row['ALLERGY_INFORMATION'];
	$category = $row['CATEGORY_ID'];
	$orderid=$row['ORDER_ID'];
	$shopid=$row['SHOP_ID'];
	$userid=$row['USER_ID'];
	$discountid= $row['DISCOUNT_ID'];


	echo "

	<!-- Start Single Product -->
	<div class='product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12'>
	<div class='product__thumb'>
		<a class='first__img' href='singleproduct.php?productdi=$productid'><img src='trader_area/product_images/$productimage' alt='$productname'></a>											
		<div class='hot__box'>
			<span class='hot-label'>$productstatus
			</span>
		</div>
	</div>
	<div class='product__content content--center'>
		<h4><a href='singleproduct.php'>$productname</a></h4>
		<ul class='prize d-flex'>
			<li>$ $productprice</li>
		</ul>
		<div class='action'>
		<div class='actions_inner'>
		<ul class='add_to_links'>
			<li><a class='cart' href='include/cart/cartadder.include.php?productid=$productid'><i class='bi bi-shopping-bag4'></i></a></li>
			<li><a class='compare' href='index.php?wishadd=$productid'><i class='bi bi-heart-beat'></i></a></li>
		</ul>
	</div>
							</div>
	</div>
	</div>
	<!-- End Single Product -->

	";


}


}
else{
	$disper=0;
	$finalprice=0;
	$sql_login = "SELECT  * FROM PRODUCT"; 

	$login_stmt = oci_parse($conn, $sql_login);

	if(!$login_stmt)
	{
	echo "An error occurred in parsing the sql string.\n"; 
	exit; 
	}

	oci_execute($login_stmt);

	while (($row= oci_fetch_array($login_stmt))==true)
	{
		$productid = $row['PRODUCT_ID'];
		$productname = $row['PRODUCT_NAME'];
		$productdesc = $row ['PRODUCT_DESCRIPTION'];
		$productstatus =$row['PRODUCT_STATUS'];
		$productimage= $row['PRODUCT_IMAGE'];
		$productprice=$row['PRODUCT_PRICE'];
		$productkeywords= $row['PRODUCT_KEYWORDS'];
		$minimumorder= $row['MIN_ORDER'];
		$maximumorder = $row['MAX_ORDER'];
		$allergy =$row['ALLERGY_INFORMATION'];
		$category = $row['CATEGORY_ID'];
		$orderid=$row['ORDER_ID'];
		$shopid=$row['SHOP_ID'];
		$userid=$row['USER_ID'];
		$discountid= $row['DISCOUNT_ID'];


		echo "
	
		<!-- Start Single Product -->
		<div class='product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12'>
		<div class='product__thumb'>
			<a class='first__img' href='singleproduct.php?productdi=$productid'><img src='trader_area/product_images/$productimage' alt='$productname'></a>											
			<div class='hot__box'>
				<span class='hot-label'>$productstatus
				</span>
			</div>
		</div>
		<div class='product__content content--center'>
			<h4><a href='singleproduct.php'>$productname</a></h4>

			";
			$Dquery="SELECT * from discount where DISCOUNT_ID=$discountid";
			
	$Dlogin_stmt = oci_parse($conn, $Dquery);

	if(!$Dlogin_stmt)
	{
	echo "An error occurred in parsing the sql string. on discount \n"; 
	exit; 
	}

	oci_execute($Dlogin_stmt);
	if($rowd= oci_fetch_array($Dlogin_stmt))
	{
		$disper=$rowd['DISCOUNT_PERCENTAGE'];
		$dispers=($disper*$productprice)/100;
        $finalprice =$productprice-$dispers;

		echo "<ul class='prize d-flex'>
				<li>$ $finalprice</li>
				<li class='old_prize'>$ $productprice</li>
			</ul>";

	}
	else{
		echo "<ul class='prize d-flex'>
		<li>$ $productprice</li>
	</ul>";
	}
			
			echo "
			<div class='action'>
			<div class='actions_inner'>
			<ul class='add_to_links'>
				<li><a class='cart' href='include/cart/cartadder.include.php?productid=$productid'><i class='bi bi-shopping-bag4'></i></a></li>
				<li><a class='compare' href='index.php?wishadd=$productid'><i class='bi bi-heart-beat'></i></a></li>
			</ul>
		</div>
								</div>
		</div>
		</div>
		<!-- End Single Product -->
	
		";


}
}


								?>

	        						
	        				
	        					</div>
	        					<ul class="wn__pagination">
	        						<li class="active"><a href="#">1</a></li>
	        						<li><a href="#">2</a></li>
	        						<li><a href="#">3</a></li>
	        						<li><a href="#">4</a></li>
	        						<li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
	        					</ul>
	        				</div>
	        				
        				</div>
        			</div>
        		</div>
        	</div>
        </div>