<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg" style='background-color:RGB(211, 215, 222);'>
        	<div class="container">			
        			<div class="col-lg-9 col-12 order-1 order-lg-2">
        			
					<?php
						$sql_login = "	SELECT * FROM USERA WHERE USER_TYPE='trader'"; 

						$login_stmt = oci_parse($conn, $sql_login);

						if(!$login_stmt)
							{
								echo "An error occurred in parsing the sql string.\n"; 
								exit; 
							}
		
							oci_execute($login_stmt);
							 

							while (($row= oci_fetch_array($login_stmt))==true)
								{
								$username = $row['USERNAME'];
								$userid = $row['USER_ID'];
								$userdesc = $row ['USER_DESCRIPTION'];
								$useremail = $row ['USER_EMAIL'];
								$usercontact = $row ['USER_PHONE'];
								$useraddress = $row ['USER_ADDRESS'];
								$userimage= $row['USER_IMAGE'];
								$discountid= $row['DISCOUNT_ID'];



						
								echo "
						
								<div class='tab__container'>
								<div class='shop-grid tab-pane fade show active' id='nav-list' role='tabpanel'>
									<div class='list__view__wrapper'>
										<!-- Start Single Product -->
										<div class='list__view'>
											<div class='thumb'>
												<img src='trader_area/trader_images/$userimage' alt='$userimage' style='margin:20px;'>
												
											</div>
											<div class='content'>
												<h2 style='color:RGB(237, 123, 78)'>$username</h2>
												<h5>$useremail</h5>
												<h5>$usercontact</h5>
												
												<p>$userdesc</p>
												
	
											</div>
										</div>
										<!-- End Single Product -->
	        						
	        					</div>
	        				</div>
						</div>";
								}?>
        			</div>
        		
        	</div>
        </div>