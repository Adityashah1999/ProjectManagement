 <!-- Start main Content -->

 <?php

if (!isset($_GET['productdi']))
{
	echo "<h1> Please select a product</h1>";
}
else{


	$productid=$_GET['productdi'];


	$sql_login = "	SELECT * FROM PRODUCT p  , CATEGORY C where  p.CATEGORY_ID = C.CATEGORY_ID AND p.PRODUCT_ID = $productid"; 

$login_stmt = oci_parse($conn, $sql_login);

if(!$login_stmt)
{
    echo "An error occurred in parsing the sql string.\n"; 
    exit; 
}

oci_execute($login_stmt);

if ($row = oci_fetch_assoc($login_stmt))
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
	$category_name= $row['CATEGORY_NAME'];
	$orderid=$row['ORDER_ID'];
	$shopid=$row['SHOP_ID'];
	$userid=$row['USER_ID'];
	$discountid= $row['DISCOUNT_ID'];


	echo " <div class='maincontent bg--white pt--80 pb--55' >
	<div class='container'>
		<div class='row'>
			<div class='col-lg-9 col-12'>
				<div class='wn__single__product'>
					<div class='row'>
						<div class='col-lg-6 col-12'>
							<div class='wn__fotorama__wrapper'>
								<div class='fotorama wn__fotorama__action' data-nav='thumbs'>
									  <a href='1.jpg'><img src='trader_area/product_images/$productimage' alt=''></a>
						
								</div>
							</div>
						</div>
						<div class='col-lg-6 col-12'>
							<div class='product__info__main'>
								<h1>$productname</h1>
								
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

		echo "			
			<div class='price-box' style='display:flex;'>
		<span>$ $finalprice</span>
		<span style='font-size:16px;padding-left:15px;color:red;'><del>$ $productprice</del></span>
	</div>
			";

	}
	else{
		echo "<div class='price-box'>
		<span>$ $productprice</span>
	</div>";
	}
			
			echo "
								
								<div class='product__overview'>
								<p>$productdesc</p>
								</div>
								<div class='product__overview'>
								<p><strong>Persons who cannot have the product : $allergy</strong></p>
								</div>

								<div class='product__overview'>
								<p> GET DISCOUNT ON COUPON CODE <strong>HIGH_DISCOUNT</strong></p>
								</div>
								<div class='box-tocart d-flex'>
									<span>Qty</span>
									<form action ='include/products/singlecartadder.include.php' method='get '>
									<input id='qty' class='input-text qty' name='qty' max='$maximumorder' min='$minimumorder' value='$minimumorder' title='Qty' type='number'>
									<input name='proid' type='number' value ='$productid' style='display:none'>
									<div class='addtocart__actions'>
										<button class='tocart' name= 'addsubmit' type='submit' value ='1' title='Add to cart'>Add to cart</button>
									</div>
									</form>
									<div class='product-addto-links clearfix'>
										<a class='wishlist' href='#'></a>
										<a class='compare' href='#'></a>
									</div>
								</div>
								<div class='product_meta'>
									<span class='posted_in'>Category: 
										<a href=''>$category_name</a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				";
			
			
			}

				
				?>

				<div class='product__info__detailed'>
					<div class='pro_details_nav nav justify-content-start' role='tablist'>
						<a class='nav-item nav-link ' data-toggle='tab' href='#nav-review' role='tab'>Reviews</a>
					</div>
					<div class='tab__container'>
						<!-- Start Single Tab Content -->
						<div class='pro__tab_label tab-pane fade' id='nav-review' role='tabpanel'>
							<div class='review__attribute'>
								<h1>Customer Reviews</h1>
								
								<?php

								
	$sql_login_stmt = "	SELECT * FROM PRODUCT p , REVIEW r ,  USERA u where p.PRODUCT_ID = R.PRODUCT_ID AND r.USER_ID = u.USER_ID  AND p.PRODUCT_ID = $productid"; 

	$login_stmt = oci_parse($conn, $sql_login_stmt);
	
	if(!$login_stmt)
	{
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
	}
	
	oci_execute($login_stmt);
	
	while ($row = oci_fetch_assoc($login_stmt))
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
		$rating = $row['RATING_REVIEW'];
		$reviewcomment=$row['REVIEW_COMMENT'];
		$username=$row['USERNAME'];
		$reviewtime=$row['REVIEW_TIME'];

		echo "
									
								<div class='review__ratings__type d-flex'>
									<div class='review-ratings'>
										<div class='rating-summary d-flex'>
											<span>Ratings ( of 5) </span>
											<ul class='rating d-flex'>
											";
											for ($i=1;$i<=$rating;$i++){
												echo"
												<li><i class='zmdi zmdi-star'></i></li>";
											}
											echo"
											</ul>
										</div>
									</div>
									<div class='review-content'>
										<p style='font-size:20px;'>'$reviewcomment'</p>
										<p>Review by $username</p>
										<p>Posted on $reviewtime</p>
									</div>
								</div>
								";

										}?>

							</div>
							<div class='review-fieldset'>
								<h2>You're reviewing:</h2>
								<h3><?php echo $productname ?></h3>
								<form action ='' method='post'>
								<div class='review_form_field'>
									<div class='input__box'>
										<span>Rating</span>
										<input id='qty' class='input-text qty' name='rating' max='5' min='1' value='1' title='Qty' type='number'>										
									</div>
									<div class='input__box'>
										<span>Summary</span>
										<input id='summery_field' type='text' name='summery'>
									</div>
									<div class='review-form-actions'>
										<button name='reviewsubmit'>Submit Review</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						<!-- End Single Tab Content -->
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!-- End main Content -->
<?php
}

if (isset($_POST['reviewsubmit'])){

	$ratings=$_POST['rating'];
	$ratings_comment= $_POST['summery'];

	$t=time();
	$date = date("Y-m-d",$t);
	
	$idp=$_GET['productdi'];

	
	if (isset($_SESSION['customer_id']))
	{
		$cus=$_SESSION['customer_id'];

		$qry= "INSERT INTO REVIEW(REVIEW_ID,REVIEW_COMMENT,RATING_REVIEW,REVIEW_TIME,USER_ID,PRODUCT_ID) VALUES	(null,'$ratings_comment','$ratings',SYSDATE,'$cus','$idp')";

		$login_stmt = oci_parse($conn, $qry);

		if(!$login_stmt)
		{
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
		}

		oci_execute($login_stmt);
	}
	else if (isset($_SESSION['admin_id']))
	{
		$admin=$_SESSION['admin_id'];
		$qry= "INSERT INTO REVIEW(REVIEW_ID,REVIEW_COMMENT,RATING_REVIEW,REVIEW_TIME,USER_ID,PRODUCT_ID) VALUES	(null,'$ratings_comment','$ratings',SYSDATE,'$admin','$idp')";

		$login_stmt = oci_parse($conn, $qry);

		if(!$login_stmt)
		{
		echo "An error occurred in parsing the sql string.\n"; 
		exit; 
		}

		oci_execute($login_stmt);
	}




	}
	

?>