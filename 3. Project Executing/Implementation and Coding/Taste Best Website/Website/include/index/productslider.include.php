<?php
$i=rand(16,19);
$sql_login = "SELECT * FROM PRODUCT where USER_ID='$i'"; 


$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

$query="SELECT * FROM USERA WHERE USER_ID = '$i'";

$sle = oci_parse($conn, $query);

if(!$sle)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($sle);

$name_fetch= oci_fetch_assoc($sle);

$traderName= $name_fetch['USERNAME'];
$traderDesc= $name_fetch['USER_DESCRIPTION'];

echo " 
<section class='wn__product__area brown--color pt--80  pb--30' style='background-color:RGB(211, 215, 222);'>
			<div class='container'>
				<div class='row'>
					<div class='col-lg-12'>
						<div class='section__title text-center'>
							<h2 class='title__be--2'>Trader :<span class='color--theme'> $traderName</span></h2>
							<p>$traderDesc</p>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<div class='furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50'>

	" ;

while (($row= oci_fetch_array($login_stmt))==true)
{
	$productname = $row['PRODUCT_NAME'];
	$productid = $row['PRODUCT_ID'];
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
					<div class='product product__style--3'>
						<div class='col-lg-3 col-md-4 col-sm-6 col-12'>
							<div class='product__thumb'>
								<a class='first__img' href='singleproduct.php?productdi=$productid'><img src='trader_area/product_images/$productimage	' alt='$productname'></a>
								<div class='hot__box'>
									<span class='hot-label'>$productstatus</span>
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
					</div>
					<!-- END Single Product -->
	
	";


}
?>

					
					<!-- Start Single Product -->
				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>